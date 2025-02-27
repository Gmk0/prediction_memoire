from flask import Flask, request, jsonify
import joblib
import pandas as pd
import matplotlib.pyplot as plt
import io
import base64

import os
from recommendation_engine import RecommendationEngine

app = Flask(__name__)


# Charger le modèclsle, le scaler pour l'âge et les noms des colonnes
model = joblib.load('Prediction Api/Random_Forest_model_new.pkl')
scaler_age = joblib.load('Prediction Api/scaler_age_new.pkl')
columns = joblib.load('Prediction Api/colonnes.pkl')

# Initialiser l'engin de recommandation
recommendation_engine = RecommendationEngine()

# Fonction pour sauvegarder les résultats dans un fichier CSV
def save_to_csv(input_data, prediction, prediction_proba):
    # Créer un DataFrame avec les données d'entrée et les résultats de prédiction
    result_df = pd.DataFrame(input_data, columns=columns)
    result_df['prediction'] = prediction
    result_df['probability_class_0'] = prediction_proba[:, 0]
    result_df['probability_class_1'] = prediction_proba[:, 1]

    # Sauvegarder dans un fichier CSV (ajout)
    file_path = 'predictions.csv'
    if os.path.exists(file_path):
        result_df.to_csv(file_path, mode='a', header=False, index=False)
    else:
        result_df.to_csv(file_path, mode='w', header=True, index=False)

@app.route('/predict', methods=['POST'])

def predict():
    """
    Prediction API
    """
    try:
        # Charger les données d'entrée
        data = request.get_json(force=True)
        input_data = data['features']

        # Forcer la conversion en entiers
        input_data = [int(x) for x in input_data]

        # Convertir les données d'entrée en DataFrame avec les noms des colonnes appropriés
        input_df = pd.DataFrame([input_data], columns=columns)

        # Normaliser uniquement la colonne 'age'
        if 'age' in input_df.columns:
            input_df['age'] = scaler_age.transform(input_df[['age']])

        # Effectuer la prédiction
        prediction = model.predict(input_df)
        prediction_proba = model.predict_proba(input_df)

        # Convertir les probabilités en pourcentage
        prediction_proba_percentage = [round(prob * 100, 2) for prob in prediction_proba[0]]

        # Générer des recommandations basées sur les caractéristiques et les probabilités
        interpretation, recommendations = recommendation_engine.generate_recommendations(input_data, prediction[0], prediction_proba[0])

        # Sauvegarder les résultats dans un fichier CSV
        save_to_csv([input_data], prediction, prediction_proba)

        # Résultat
        result = {
            "prediction": int(prediction[0]),
            "probability": {
                "class_0": prediction_proba_percentage[0],
                "class_1": prediction_proba_percentage[1]
            },
            "interpretation": interpretation,
            "recommendations": recommendations
        }

        return jsonify(result)

    except Exception as e:
        return jsonify({"error": str(e)}), 400

@app.route('/results', methods=['GET'])
def get_results():
    """
    Get saved predictions
    """
    file_path = 'predictions.csv'
    if os.path.exists(file_path):
        df = pd.read_csv(file_path)
        return df.to_json(orient='records')
    else:
        return jsonify({"error": "Le fichier predictions.csv n'existe pas encore."}), 404


@app.route('/stats', methods=['GET'])
def get_stats():
    """
    Get basic statistics of the predictions
    """
    file_path = 'predictions.csv'
    if os.path.exists(file_path):
        df = pd.read_csv(file_path)
        total_predictions = df.shape[0]
        class_0_count = df[df['prediction'] == 0].shape[0]
        class_1_count = df[df['prediction'] == 1].shape[0]

        # Generate a pie chart
        labels = 'Class 0', 'Class 1'
        sizes = [class_0_count, class_1_count]
        colors = ['lightblue', 'lightcoral']
        explode = (0.1, 0)  # explode 1st slice

        plt.figure(figsize=(6, 6))
        plt.pie(sizes, explode=explode, labels=labels, colors=colors,
                autopct='%1.1f%%', shadow=True, startangle=140)
        plt.axis('equal')  # Equal aspect ratio ensures that pie is drawn as a circle.

        # Save the plot to a PNG image in memory
        img = io.BytesIO()
        plt.savefig(img, format='png')
        img.seek(0)
        plot_url = base64.b64encode(img.getvalue()).decode()

        stats = {
            "total_predictions": total_predictions,
            "class_0_predictions": class_0_count,
            "class_1_predictions": class_1_count,
            "class_0_percentage": round((class_0_count / total_predictions) * 100, 2),
            "class_1_percentage": round((class_1_count / total_predictions) * 100, 2),
            "plot_url": f"data:image/png;base64,{plot_url}"
        }
        return jsonify(stats)
    else:
        return jsonify({"error": "Le fichier predictions.csv n'existe pas encore."}), 404



if __name__ == '__main__':
    app.run(debug=True, port=5000)

