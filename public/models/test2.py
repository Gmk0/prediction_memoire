from flask import Flask, request, jsonify
import joblib
import pandas as pd
import numpy as np
from flasgger import Swagger, swag_from

app = Flask(__name__)
swagger = Swagger(app)

# Charger le modèle, le scaler pour l'âge et les noms des colonnes
model = joblib.load('random_forest_model.pkl')
scaler_age = joblib.load('scaler_age.pkl')
columns = joblib.load('colonnes.pkl')

@app.route('/predict', methods=['POST'])
@swag_from('predict.yml')
def predict():

    try:
        # Charger les données d'entrée
        data = request.get_json(force=True)
        input_data = np.array([data['features']])

        # Convertir les données d'entrée en DataFrame avec les noms des colonnes appropriés
        input_df = pd.DataFrame(input_data, columns=columns)

        # Normaliser uniquement la colonne 'age'
        if 'age' in input_df.columns:
            input_df['age'] = scaler_age.transform(input_df[['age']])

        # Effectuer la prédiction
        prediction = model.predict(input_df)
        prediction_proba = model.predict_proba(input_df)

        # Convertir les probabilités en pourcentage
        prediction_proba_percentage = [round(prob * 100, 2) for prob in prediction_proba[0]]

        # Résultat
        result = {
            "prediction": int(prediction[0]),
            "probability": {
                "class_0": prediction_proba_percentage[0],
                "class_1": prediction_proba_percentage[1]
            }
        }

        return jsonify(result)

    except Exception as e:
        return jsonify({"error": str(e)}), 400

if __name__ == '__main__':
    app.run(debug=True, port=5000)
