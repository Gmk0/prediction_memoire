from flask import Flask, request, jsonify
import joblib
import numpy as np
import pandas as pd
from flasgger import Swagger, swag_from

app = Flask(__name__)
swagger = Swagger(app)

# Charger le scaler et le modèle
scaler = joblib.load('scaler.pkl')
features = ['sexe', 'age', 'hypertension', 'maladie_cardiaque', 'historique_tabagisme', 'IMC', 'niveau_HbA1c', 'niveau_glycémie']
best_model_name = 'Logistic Regression'  # Remplacer par le nom du meilleur modèle trouvé
model = joblib.load(f'{best_model_name}_model.pkl')

@app.route('/predict', methods=['POST'])
@swag_from({
    'tags': ['Prediction'],
    'parameters': [
        {
            'name': 'body',
            'in': 'body',
            'required': True,
            'schema': {
                'type': 'object',
                'properties': {
                    'features': {
                        'type': 'array',
                        'items': {
                            'type': 'number'
                        },
                        'example': [1, 45, 1, 0, 1, 22.5, 5.6, 120]
                    }
                }
            }
        }
    ],
    'responses': {
        200: {
            'description': 'Prediction results',
            'schema': {
                'type': 'object',
                'properties': {
                    'prediction': {
                        'type': 'integer',
                        'example': 1
                    },
                    'prediction_proba': {
                        'type': 'object',
                        'example': {
                            '0': '30.00%',
                            '1': '70.00%'
                        }
                    }
                }
            }
        }
    }
})
def predict():
    """
    Predict the outcome based on the input features
    """
    data = request.get_json(force=True)
    print(f"Received data: {data}")
    
    input_data = np.array([data['features']])
    print(f"Input data (array): {input_data}")

    # Créer un DataFrame avec les nouvelles données et les noms des colonnes
    new_data_df = pd.DataFrame(input_data, columns=features)
    print(f"New data DataFrame: {new_data_df}")

    # Transformation des nouvelles données avec le scaler sauvegardé
    input_data_scaled = scaler.transform(new_data_df)
    print(f"Scaled input data: {input_data_scaled}")

    # Faire des prédictions
    prediction = model.predict(input_data_scaled)
    prediction_proba = model.predict_proba(input_data_scaled)
    print(f"Prediction: {prediction}")
    print(f"Prediction probabilities: {prediction_proba}")

    # Construire la réponse avec les probabilités en pourcentage
    prediction_elemet = {}
    class_labels = model.classes_
    for prob, label in zip(prediction_proba[0], class_labels):
        prediction_elemet[str(label)] = f"{prob * 100:.2f}%"

    response = {
        'prediction': int(prediction[0]),
        'prediction_proba': prediction_elemet
    }
    
    return jsonify(response)

if __name__ == '__main__':
    app.run(debug=True)
