import pandas as pd

class RecommendationEngine:
    def __init__(self):
        self.columns = ['age', 'sexe', 'polyurie', 'polydipsie', 'perte_de_poids_soudaine',
                        'faiblesse', 'polyphagie', 'vision_floue', 'obesite',
                        'diabete_parental', 'tabagisme', 'hypertension', 'glycemie_eleve',
                        'activites_physique']

    def generate_recommendations(self, input_data, prediction, prediction_proba):
        recommendations = []

        # Convertir les probabilités en pourcentage pour une meilleure compréhension
        proba_class_0 = round(prediction_proba[0] * 100, 2)
        proba_class_1 = round(prediction_proba[1] * 100, 2)

        # Recommandations basées sur les probabilités de classe
        if proba_class_1 >= 70:
            recommendations.append("Il est fortement recommandé de consulter un médecin dans les 6 mois.")
        elif proba_class_1 >= 40:
            recommendations.append("Il est conseillé de surveiller régulièrement votre santé et de consulter un médecin en cas de symptômes persistants.")
        # Analyse des caractéristiques individuelles
        age = input_data[0]
        sexe = input_data[1]
        glycemie_eleve = input_data[12]
        obesite = input_data[8]
        diabete_parental = input_data[9]
        hypertension = input_data[11]
        tabagisme = input_data[10]
        activites_physique = input_data[13]

        if age > 45:
            recommendations.append("En raison de votre âge, il est important de réaliser des contrôles réguliers de votre glycémie.")
        if sexe == 1:  # 1 for male, 0 for female
            recommendations.append("Les hommes ont un risque légèrement plus élevé de développer le diabète de type 2.")
        if glycemie_eleve == 1:
            recommendations.append("Votre glycémie est élevée. Consultez un professionnel de santé pour un suivi adapté.")
        if obesite == 1:
            recommendations.append("L'obésité est un facteur de risque majeur pour le diabète de type 2. Envisagez des modifications de votre mode de vie pour perdre du poids.")
        if diabete_parental == 1:
            recommendations.append("Les antécédents familiaux de diabète augmentent votre risque. Soyez vigilant et réalisez des contrôles réguliers.")
        if hypertension == 1:
            recommendations.append("L'hypertension est un facteur de risque. Contrôlez régulièrement votre pression artérielle.")
        if tabagisme == 1:
            recommendations.append("Le tabagisme augmente le risque de complications. Envisagez d'arrêter de fumer.")
        if activites_physique == 0:
            recommendations.append("L'activité physique régulière peut réduire le risque de diabète de type 2. Essayez d'intégrer plus d'exercice dans votre routine quotidienne.")

        return recommendations
