import numpy as np
import pandas as pd
import joblib

# Chargement du scaler, du modèle et des noms des colonnes sauvegardés
# Charger le modèle, le scaler pour l'âge et les noms des colonnes
model = joblib.load('random_forest_model.pkl')
scaler_age = joblib.load('scaler_age.pkl')
columns = joblib.load('colonnes.pkl')

# Supposons que vous avez de nouvelles données non standardisées
# Exemple de nouvelles données fournies par l'utilisateur
new_data = np.array([[72, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1]])  # Exemple de nouvelle entrée utilisateur

# Créer un DataFrame avec les nouvelles données et les noms des colonnes
new_data_df = pd.DataFrame(new_data, columns=columns)
if 'age' in new_data_df.columns:
            new_data_df['age'] = scaler_age.transform(new_data_df[['age']])

# Transformation des nouvelles données avec le scaler sauvegardé

# Faire des prédictions sur les nouvelles données standardisées
new_prediction = model.predict(new_data_df)
#new_prediction_proba = model.predict_proba(new_data_df)

print(f'Prediction for new data: {new_prediction[0]}')
#print(f'Prediction probabilities for new data: {new_prediction_proba[0]}')
