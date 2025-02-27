from flask import Flask, request, jsonify,make_response
from flask_restx import Api, Resource, fields
import joblib
import pandas as pd
import matplotlib.pyplot as plt
import io
import base64
import os
from recommendation_engine import RecommendationEngine

app = Flask(__name__)
api = Api(app, version='1.0', title='API de Prédiction du Diabète',
          description='Une API simple pour la prédiction du diabète')

ns = api.namespace('predict', description='Opérations de prédiction')


# Charger le modèle, le scaler pour l'âge et les noms des colonnes
<<<<<<< HEAD
model = joblib.load('Random_Forest_model_new.pkl')
scaler_age = joblib.load('scaler_age_new.pkl')
columns = joblib.load('colonnes.pkl')
=======
model = joblib.load('Random Forest_model1.pkl')
scaler_age = joblib.load('scaler_age_new2.pkl')
columns = joblib.load('columns.pkl')
>>>>>>> 0421a81fa7cc0d44fe6c801b56484b418d9da7b4

# Initialiser l'engin de recommandation
recommendation_engine = RecommendationEngine()

# Définir le modèle de données pour l'API
prediction_model = ns.model('Prediction', {
    'features': fields.List(fields.Integer, required=True, description='Features pour la  prediction')
})

# Fonction pour sauvegarder les résultats dans un fichier CSV
def save_to_csv(input_data, prediction, prediction_proba):
    result_df = pd.DataFrame(input_data, columns=columns)
    result_df['prediction'] = prediction
    result_df['probability_class_0'] = prediction_proba[:, 0]
    result_df['probability_class_1'] = prediction_proba[:, 1]

    file_path = 'predictions.csv'
    if os.path.exists(file_path):
        result_df.to_csv(file_path, mode='a', header=False, index=False)
    else:
        result_df.to_csv(file_path, mode='w', header=True, index=False)

@ns.route('/')
class Predict(Resource):
    @ns.doc('predict')
    @ns.expect(prediction_model)
    def post(self):
        """
        Prediction API
        """
        try:
            # Charger les données d'entrée
            data = request.get_json(force=True)
            if 'features' not in data or len(data['features']) != len(columns):
<<<<<<< HEAD
               return make_response(jsonify({"error": f"Les caractéristiques doivent contenir les éléments suivants: {columns}"}), 400)
=======
                return make_response(jsonify({"error": f"Les caractéristiques doivent contenir les éléments suivants: {columns}"}), 400)

>>>>>>> 0421a81fa7cc0d44fe6c801b56484b418d9da7b4
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

<<<<<<< HEAD
            return make_response(jsonify(result),200)
=======
            return make_response(jsonify(result))
>>>>>>> 0421a81fa7cc0d44fe6c801b56484b418d9da7b4

        except Exception as e:
            return make_response(jsonify({"error": str(e)}), 400)

@ns.route('/results')
class Results(Resource):
    def get(self):
        """
        Get saved predictions
        """
        file_path = 'predictions.csv'
        if os.path.exists(file_path):
            df = pd.read_csv(file_path)
            return jsonify(df.to_dict(orient='records'))
        else:
            return jsonify({"error": "Le fichier predictions.csv n'existe pas encore."}), 404

@ns.route('/stats')
class Stats(Resource):
    def get(self):
        """
        Recuperer  les statistiques des predictions
        """
        file_path = 'predictions.csv'
        if os.path.exists(file_path):
            df = pd.read_csv(file_path)
            total_predictions = df.shape[0]
            class_0_count = df[df['prediction'] == 0].shape[0]
            class_1_count = df[df['prediction'] == 1].shape[0]

            # Generer le  pie chart
            labels = 'Class 0', 'Class 1'
            sizes = [class_0_count, class_1_count]
            colors = ['lightblue', 'lightcoral']
            explode = (0.1, 0)  # explode 1st slice

            plt.figure(figsize=(6, 6))
            plt.pie(sizes, explode=explode, labels=labels, colors=colors,
                    autopct='%1.1f%%', shadow=True, startangle=140)
            plt.axis('equal')

            # Sauvegarder le char en png
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

api.add_namespace(ns, path='/predict')

if __name__ == '__main__':
    app.run(debug=True, port=5000)

