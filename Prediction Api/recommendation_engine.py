import pandas as pd

class RecommendationEngine:
    def __init__(self):
        self.columns = ['age', 'sexe', 'polyurie', 'polydipsie', 'perte_de_poids_soudaine',
                        'faiblesse', 'polyphagie', 'vision_floue', 'obesite',
                        'diabete_parental', 'tabagisme', 'hypertension', 'glycemie_eleve',
                        'activites_physique']
        self.tabagisme_mapping = {0: 'jamais', 1: 'ancien', 2: 'actuel'}
        self.activite_physique_mapping = {0: 'faible', 1: 'modere', 2: 'eleve'}

    def generate_recommendations(self, input_data, prediction, prediction_proba):
        recommendations = set()
        interpretation = ""

        # Convertir les probabilités en pourcentage pour une meilleure compréhension
        proba_class_0 = round(prediction_proba[0] * 100, 2)
        proba_class_1 = round(prediction_proba[1] * 100, 2)

        # Interprétation des résultats
        if prediction == 1:
            interpretation = f"Il y a une probabilité de {proba_class_1}% que vous développiez le diabète de type 2."
        else:
            interpretation = f"Il y a une probabilité de {proba_class_0}% que vous ne développiez pas le diabète de type 2."

        # Recommandations basées sur les probabilités de classe
        if proba_class_1 >= 70:
            recommendations.add("Il est fortement recommandé de consulter un médecin dans les 6 mois.")
        elif proba_class_1 >= 40:
            recommendations.add("Surveillez régulièrement votre santé et consultez un médecin en cas de symptômes persistants.")
        else:
            recommendations.add("Votre risque de diabète de type 2 est faible. Continuez à maintenir un mode de vie sain.")

        # Analyse des caractéristiques individuelles
        age = input_data[0]
        sexe = input_data[1]
        polyurie = input_data[2]
        polydipsie = input_data[3]
        perte_de_poids_soudaine = input_data[4]
        faiblesse = input_data[5]
        polyphagie = input_data[6]
        vision_floue = input_data[7]
        obesite = input_data[8]
        diabete_parental = input_data[9]
        tabagisme = input_data[10]
        hypertension = input_data[11]
        glycemie_eleve = input_data[12]
        activites_physique = input_data[13]

        # Conseils généraux
        if age > 45:
            recommendations.add("En raison de votre âge, il est important de réaliser des contrôles réguliers de votre glycémie.")
        if sexe == 1:  # 1 for male, 0 for female
            recommendations.add("Les hommes ont un risque légèrement plus élevé de développer le diabète de type 2.")
        if polyurie == 1:
            recommendations.add("Vous avez signalé une polyurie. Consultez un médecin si cela persiste.")
        if polydipsie == 1:
            recommendations.add("Vous avez signalé une polydipsie. Consultez un médecin si cela persiste.")
        if perte_de_poids_soudaine == 1:
            recommendations.add("Vous avez signalé une perte de poids soudaine. Consultez un médecin pour un bilan de santé.")
        if faiblesse == 1:
            recommendations.add("Vous avez signalé une faiblesse. Consultez un médecin si cela persiste.")
        if polyphagie == 1:
            recommendations.add("Vous avez signalé une polyphagie. Consultez un médecin si cela persiste.")
        if vision_floue == 1:
            recommendations.add("Vous avez signalé une vision floue. Consultez un ophtalmologue pour un examen de la vue.")
        if obesite == 1:
            recommendations.add("L'obésité est un facteur de risque majeur. Adoptez un mode de vie plus sain pour perdre du poids.")
        if diabete_parental == 1:
            recommendations.add("Les antécédents familiaux augmentent votre risque. Réalisez des contrôles réguliers.")
        if hypertension == 1:
            recommendations.add("L'hypertension est un facteur de risque. Surveillez votre pression artérielle régulièrement.")
        if glycemie_eleve == 1:
            recommendations.add("Votre glycémie est élevée. Consultez un professionnel de santé pour un suivi adapté.")
        if tabagisme == 2:
            recommendations.add("Vous êtes un fumeur actuel. Le tabagisme augmente le risque de complications. Envisagez d'arrêter de fumer.")
        elif tabagisme == 1:
            recommendations.add("Vous êtes un ancien fumeur. Continuez à éviter le tabac pour réduire les risques.")
        if activites_physique == 0:
            recommendations.add("Votre niveau d'activité physique est faible. Intégrez plus d'exercice dans votre routine quotidienne.")
        elif activites_physique == 1:
            recommendations.add("Votre niveau d'activité physique est modéré. Augmentez votre activité pour améliorer encore plus votre santé.")
        elif activites_physique == 2:
            recommendations.add("Votre niveau d'activité physique est élevé. Continuez ainsi pour maintenir votre santé.")

        # Conseils supplémentaires basés sur les combinaisons de facteurs de risque
        if obesite == 1 and activites_physique == 0:
            recommendations.add("Adoptez un mode de vie plus actif et surveillez votre alimentation pour gérer votre obésité.")
        if diabete_parental == 1 and glycemie_eleve == 1:
            recommendations.add("Avec des antécédents familiaux et une glycémie élevée, un suivi médical régulier est recommandé.")
        if hypertension == 1 and tabagisme == 2:
            recommendations.add("Hypertension et tabagisme augmentent considérablement les risques. Arrêtez de fumer et surveillez votre pression artérielle.")
        if age > 60 and activites_physique == 0:
            recommendations.add("À votre âge, un faible niveau d'activité physique peut augmenter les risques. Consultez un professionnel de santé pour un programme d'exercice adapté.")
        if sexe == 0 and age > 50:
            recommendations.add("Les femmes de plus de 50 ans doivent surveiller les changements hormonaux influençant le risque de diabète. Consultez votre médecin pour un suivi.")
        if faiblesse == 1 and polyphagie == 1:
            recommendations.add("La faiblesse et la polyphagie peuvent indiquer une mauvaise gestion de la glycémie. Consultez un professionnel de santé.")
        if perte_de_poids_soudaine == 1 and obesite == 1:
            recommendations.add("Une perte de poids soudaine en présence d'obésité peut être un signe de diabète. Consultez un médecin.")
        if vision_floue == 1 and hypertension == 1:
            recommendations.add("La vision floue et l'hypertension peuvent augmenter les risques de complications. Consultez un ophtalmologue et surveillez votre pression artérielle.")
        if polyurie == 1 and vision_floue == 1:
            recommendations.add("Polyurie et vision floue peuvent indiquer des niveaux élevés de sucre dans le sang. Consultez un médecin.")
        if faiblesse == 1 and glycemie_eleve == 1:
            recommendations.add("La faiblesse accompagnée d'une glycémie élevée nécessite une attention médicale immédiate. Consultez votre médecin.")
        if age > 70 and hypertension == 1:
            recommendations.add("Les personnes de plus de 70 ans avec de l'hypertension doivent surveiller leur santé de près et consulter régulièrement leur médecin.")
        if diabete_parental == 1 and activites_physique == 0:
            recommendations.add("Avec des antécédents familiaux et un faible niveau d'activité physique, il est essentiel d'adopter un mode de vie plus actif.")
        if tabagisme == 2 and age > 50:
            recommendations.add("Le tabagisme à un âge avancé augmente considérablement les risques de complications. Arrêtez de fumer.")
        if hypertension == 1 and obesite == 1:
            recommendations.add("Hypertension et obésité forment une combinaison dangereuse. Travaillez avec un professionnel de la santé pour gérer votre poids et votre pression artérielle.")
        if glycemie_eleve == 1 and activites_physique == 0:
            recommendations.add("Une glycémie élevée et un faible niveau d'activité physique nécessitent une attention médicale. Consultez un médecin pour des conseils sur l'exercice et la nutrition.")
        if age > 65 and perte_de_poids_soudaine == 1:
            recommendations.add("Une perte de poids soudaine chez les personnes de plus de 65 ans peut être préoccupante. Consultez un médecin.")
        if faiblesse == 1 and hypertension == 1:
            recommendations.add("La faiblesse et l'hypertension peuvent indiquer des complications. Surveillez votre pression artérielle et consultez un médecin.")
        if polyphagie == 1 and obesite == 1:
            recommendations.add("Polyphagie en présence d'obésité peut indiquer un déséquilibre glycémique. Consultez un médecin.")
        if age > 60 and obesite == 1:
            recommendations.add("L'obésité après 60 ans augmente les risques de complications. Adoptez un mode de vie plus sain et consultez régulièrement votre médecin.")
        if age > 70 and tabagisme == 2:
            recommendations.add("Fumer après 70 ans est particulièrement dangereux. Arrêtez de fumer pour améliorer votre santé.")
        if diabete_parental == 1 and hypertension == 1:
            recommendations.add("Les antécédents familiaux de diabète et l'hypertension forment une combinaison à haut risque. Surveillez votre santé de près et consultez régulièrement votre médecin.")

        return interpretation, list(recommendations)
