Matthieu FARANDJIS, Florent VASSEUR--BERLIOUX, Tom BOGAERT, Assia GOUABI, Enzo GUIGNOLLE<br>
INF2-A

<div align="center">
<img height="95" width="400" src="../img/IUT_Velizy_Villacoublay_logo_2020_ecran.png" title="logo uvsq vélizy"/>

# SAÉ S3 - Rapport sur l'application Shiny

<br><br>
Ce document en lien à notre devoir de Probas/stats fait une etude de l'application Shiny.<br>
Nous présenterons Shiny et notre application Shiny.<br>
<br>
</div>

<br><br>

---
## Plan

- ### [I – Shiny](#p1)
  - [**a) Présentation**](#p1a)
  - [**b) Architecture de Shiny**](#p1b)
  - [**c) Composants Clés : Inputs et Outputs**](#p1c)
  - [**d) Layouts et Panels**](#p1d)
  - [**e) Réactivité : Fondement de Shiny**](#p1e)
  - [**f) Structures Réactives**](#p1f)
  - [**g) Mécanismes d'Observation et de Blocage**](#p1g)
  - [**h) Conclusion**](#p1h)
  
- ### [II - Notre application](#p2)
  - [**a) Présentation**](#p2a)
  - [**b) Choix de Conception Interface Utilisateur (UI)**](#p2b)
  - [**c) Choix de Conception Serveur (Server)**](#p2c)
  - [**d) Challenges Rencontrés**](#p2d)
  - [**e) Bibliothèques Utilisées**](#p2e)
  - [**f) Résultats Obtenus**](#p2f)


- ### [III – Annexe](#p3) 
  - [**a) Code de notre application Shiny**](#p3a)

---

## Shiny
- ### <a name="p1a"></a> a) Présentation

  Shiny, développé par RStudio et initialement publié en 2012, représente une extension de R permettant
  la création d'applications web interactive. En tant que composant open source,
  Shiny offre une utilisation gratuite, autorisant le développement et le déploiement d'applications
  sur une simple page web, leur intégration dans des rapports, ou la création de tableaux de bord complexes 
  avec plusieurs pages.
  <br><br>
  En interprétant le langage R, Shiny génère du code HTML, CSS et JavaScript,
  permettant ainsi l'enrichissement des applications avec des thèmes CSS,
  des widgets HTML et des actions JavaScript. Les applications Shiny peuvent également s'interconnecter
  avec d'autres extensions de R, facilitant la connexion à des bases de données,
  la création de visualisations (graphes, cartes, ...), l'exécution de traitements statistiques ou
  d'algorithmes de Machine Learning, l'intégration de scripts Python, d'API, ainsi que d'autres contenus web.

- ### <a name="p1b"></a> b) Architecture de Shiny :

  Une application Shiny se compose de deux parties principales :<br><br>
  - un côté UI qui regroupe tous les éléments de mise en forme
  et d'affichage de l'interface utilisateur elle-même (affichage des inputs et des outputs)<br>
  - un côté Server où sont exécutés les codes R qui servent à produire les outputs
  (graphiques, tables, traitements, etc.) et à les mettre à jour en cas de
  changement dans les valeurs d'inputs.
    <br><br>
  Cette séparation facilite la maintenance et la compréhension du code.


- ### <a name="p1c"></a> c) Composants Clés : Inputs et Outputs :

  - Les inputs représentent les widgets interactifs, permettant aux utilisateurs de fournir des données.
  Shiny propose une variété d'inputs tels que des champs de sélections, des boutons, et des champs de texte.
  - Les outputs affichent les résultats générés par le code R, comme des graphiques, des tables ou du texte,
  et sont automatiquement mis à jour en réponse aux changements des inputs.

- ### <a name="p1d"></a> d) Layouts et Panels :

  L'organisation de l'interface utilisateur repose sur les concepts de layouts et de panels.
  Les layouts définissent la structure spatiale des éléments, tandis que les panels regroupent
  des composants similaires. Cette approche offre une flexibilité dans la conception des interfaces,
  permettant de créer des mises en pages complexes et esthétiques.

- ### <a name="p1e"></a> e) Réactivité : Fondement de Shiny :

  La réactivité est la caractéristique centrale de Shiny. Les fonctions réactives, comme render*(),
  permettent de lier dynamiquement les inputs aux outputs. Ainsi, toute modification des inputs déclenche
  automatiquement la mise à jour des résultats, offrant une expérience utilisateur fluide et interactive.

- ### <a name="p1f"></a> f) Structures Réactives :

  Shiny utilise des structures réactives, telles que la fonction reactive(), pour stocker et mettre à jour
  efficacement des objets en réponse aux interactions de l'utilisateur. Cela améliore la performance en évitant
  la répétition de calculs inutiles et en assurant une gestion optimale des données.

- ### <a name="p1g"></a> g) Mécanismes d'Observation et de Blocage :

  Shiny propose des mécanismes d'observation pour réagir à des changements sans générer de résultats spécifiques.
  De plus, la capacité à isoler des éléments réactifs permet de contrôler finement la portée des réactions, évitant
  ainsi des comportements indésirables.


- ### <a name="p1h"></a> h) Conclusion :

  Shiny se positionne comme un outil robuste pour la conception d'applications web interactive avec R.
  Son approche déclarative, sa réactivité intégrée, et ses mécanismes avancés en font un choix attrayant
  pour ceux qui souhaitent développer des interfaces utilisateur interactives poussé, pour par exemple la présentation 
  de statistique ou d'analyse de performance comme dans le domaine du machine learning. La combinaison de ces fonctionnalités 
  en fait une solution puissante pour créer des applications web interactives de manière efficace.


- ## <a name="p2"></a> II - Notre application
  - ### <a name="p2a"></a> a) Présentation

    L'application Shiny est conçue pour offrir deux fonctionnalités principales :<br>
    - la visualisation des tickets à travers une table interactive.
    - l'analyse du nombre de tickets par mois et année.

    La structure de l'application comporte deux onglets ("Table" et "Stat nombre Ticket") permettant à l'utilisateur
    de sélectionner différentes options pour filtrer les données.

  - ### <a name="p2b"></a> b) Choix de Conception Interface Utilisateur (UI) :

  Utilisation de fluidPage pour une mise en page fluide.
  Intégration de l'interface utilisateur avec des onglets (tabPanel) pour permettre une navigation entre les différentes pages.
  Utilisation de navbarPage pour une barre de navigation.

  - ### <a name="p2c"></a> c) Choix de Conception Serveur (Server) :

  Mise en œuvre de fonctions réactives pour générer des sorties dynamiques en fonction des entrées de l'utilisateur.
  Utilisation de renderDataTable pour afficher une table interactive et renderPlot pour générer des graphiques interactifs.

  - ### <a name="p2d"></a> d) Challenges Rencontrés :

    - *Complexité Croissante* :

    Il est assez simple de comprendre le fonctionnement de Shiny mais il est un peu plus complexe à utiliser en pratique. 
    
    <br>
    
    - *Difficultés avec le Diagramme du Nombre de Tickets* :

    La création du diagramme représentant le nombre de tickets a été particulièrement ardue. Des obstacles spécifiques ont émergé lors de la manipulation des données pour obtenir des résultats cohérent et une bonne présentation.
    
    <br>
    
    - *Nécessité de Connaissances Approfondies en R* :

    Bien que Shiny offre une interface conviviale, une bonne compréhension de R est cruciale pour tirer pleinement parti de ses fonctionnalités.
    
    <br>
    
    - *Abondance d'Outils Proposés par Shiny* :

    La richesse des outils proposés par Shiny peut parfois entraîner une certaine confusion. La diversité des fonctionnalités disponibles exige une navigation attentive pour sélectionner les éléments appropriés et les intégrer de manière efficace dans l'application.
    
    <br>
    
    - *Compréhension Nécessaire des Bibliothèques Utilisées* :

    L'utilisation de plusieurs bibliothèques, telles que ggplot2, DT, et d'autres, a exigé une compréhension approfondie pour bien les utilisées dans l'application.

  - ### <a name="p2e"></a> e) Bibliothèques Utilisées :
  
    - shiny: Pour créer des applications web interactives en R.
    - ggplot2: Pour la création de graphiques.
    - DT: Pour afficher des tables de données interactives.
    - dplyr: Pour effectuer des manipulations de données.
    - lubridate: Pour travailler avec les dates.
    - shinythemes: Pour appliquer des thèmes à l'application Shiny.

  - ### <a name="p2f"></a> f) Résultats Obtenus
  
  L'application réalisée a pour but de proposer une présentation de l'activité de création de ticket réaliser
  sur notre site de ticketing TIX, même si nous avons utilisé une génération aléatoire de tickets pour réaliser
  la simulation de l'activité des tickets sur une plus grande période de temps et de nombre de tickets pour mieux visualiser l'application Shiny.
  Elle permet d'explorer les données de manière interactive. Les graphiques générés fournissent une analyse visuelle du nombre
  de tickets par mois et année, avec la possibilité d'ajouter des informations telles que la moyenne, médiane, et écart type du nombre de ticket en fonction de la sélection
  pour une analyse statistique simpliste.


- ## <a name="p3"></a> III - Annexe
    - ### <a name="p3a"></a> a) Code de notre application Shiny

```
library(shiny) #  Pour créer des applications web interactives en R.
library(ggplot2) # Pour la création de graphiques.
library(DT) # Pour afficher des tables de données interactives.
library(dplyr) # Pour effectuer des manipulations de données.
library(lubridate) # Pour travailler avec les dates.
library(shinythemes) # Pour appliquer des thèmes à votre application Shiny.


# Fonctions de calcule
moy1 = function(a){
  return(sum(a)/length(a))
}

var1=function(a){
  return(moy1(a^2)-moy1(a)^2)
}

sd1=function(a){
  return(sqrt(var1(a)))
}

# Générer des dates aléatoires dans la plage spécifiée
plage_dates <- seq(ymd_hms("2022-01-01 00:00:00"), by = "days", length.out = 740)

dates_aleatoires <- sample(plage_dates, 1000, replace = TRUE)

# Génération de tickets totalements fictifs pour une simulation
data <- data.frame(
  ID_TICKET = 1:2000,
  ID_USER = sample(1:10, 1000, replace = TRUE),
  TITRE_TICKET = sample(c("[SESSION] Autre problème", "[SALLE] Problème de la salle", "[MATERIEL] Matériel manquant", "[MATERIEL] Autre problème", "[LOGICIEL] Proposition de logiciel", "[LOGICIEL] Problème de logiciel", "[LOGICIEL] Autre problème", "[!] Autre problème"), 1000, replace = TRUE),
  DESCRIPTION_TICKET = sample(c("Problème de connexion", "Problème matériel", "Problème logiciel"), 1000, replace = TRUE),
  ID_TECHNICIEN = sample(c(1, 2, 3, 4, 5), 1000, replace = TRUE),
  NIV_URGENCE_ESTIMER_TICKET = sample(c("Faible", "Moyen", "Urgent"), 1000, replace = TRUE),
  NIV_URGENCE_DEFINITIF_TICKET = sample(c("Faible", "Moyen", "Urgent", "Non complété"), 1000, replace = TRUE),
  ETAT_TICKET = sample(c("En attente", "Ouvert", "En cours de traitement", "Fermé"), 1000, replace = TRUE),
  HORODATAGE_CREATION_TICKET = dates_aleatoires,
  HORODATAGE_DEBUT_TRAITEMENT_TICKET = sample(c(NA, seq(ymd_hms("2023-01-01 00:00:00"), by = "days", length.out = 200)), 1000, replace = TRUE),
  HORODATAGE_RESOLUTION_TICKET = sample(c(NA, seq(ymd_hms("2023-01-01 00:00:00"), by = "days", length.out = 200)), 1000, replace = TRUE),
  HORODATAGE_DERNIERE_MODIF_TICKET = seq(ymd_hms("2023-01-01 00:00:00"), by = "days", length.out = 200),
  ID_USER_DERNIERE_MODIF_TICKET = sample(1:10, 1000, replace = TRUE)
)

# Convertion des dates en objets de classe POSIXct. Ce sont des objets qui représentent des dates et heures dans R.
data$HORODATAGE_CREATION_TICKET <- as.POSIXct(data$HORODATAGE_CREATION_TICKET)
data$HORODATAGE_DEBUT_TRAITEMENT_TICKET <- as.POSIXct(data$HORODATAGE_CREATION_TICKET)
data$HORODATAGE_RESOLUTION_TICKET <- as.POSIXct(data$HORODATAGE_CREATION_TICKET)
data$ID_USER_DERNIERE_MODIF_TICKET <- as.POSIXct(data$HORODATAGE_CREATION_TICKET)

# Extraire le mois et l'année à partir de la colonne HORODATAGE_CREATION_TICKET

# Utilisation de l'opérateur %>% (pipe) pour chaîner les opérations
# Il transmet le résultat de la gauche vers la droite, améliorant la lisibilité du code.
data <- data %>%
  mutate(Mois = format(HORODATAGE_CREATION_TICKET, "%B"),
         Année = format(HORODATAGE_CREATION_TICKET, "%Y"))


# Définir l'interface utilisateur (UI)  ================================================================================================================
ui <- fluidPage(theme = shinytheme("yeti"),
                navbarPage(
                  "TIX probas/stats",
                  
                  tags$head(
                    tags$style(HTML("
                                    body {
                                      margin-top: 0; /* Ajoute une marge en haut de 100 pixels */
                                    }
                                    
                                    .centered-title {
                                      text-align: center;
                                    }
                                    #moyenne_ticket{
                                    color : blue;
                                    }
                                    #mediane_ticket{
                                    color : orange;
                                    }
                                    #sd_ticket{
                                    color : red;
                                    }
                                  "))
                  ),
                  
                  
                  tags$div(
                    style = "position: fixed; bottom: 0; width: 100%; background-color: #f8d7da; color: #721c24; text-align: center; padding: 10px;",
                    "Ces informations sont fictives et peuvent contenir des incohérences. Ne les utilisez pas concrètement."
                  ),
                  
                  # Première page
                  tabPanel("Table",
                           fluidPage(
                             
                             div(class = "centered-title", titlePanel("Table des tickets")),
                             fluidRow(
                               column(4,
                                      selectInput("titre",
                                                  "Titre de ticket:",
                                                  c("All", unique(as.character(data$TITRE_TICKET))))
                               ),
                               column(4,
                                      selectInput("etat",
                                                  "Etat de ticket:",
                                                  c("All", unique(as.character(data$ETAT_TICKET))))
                               ),
                               column(4,
                                      selectInput("idtech",
                                                  "Identifiant du technicien:",
                                                  c("All", unique(as.character(data$ID_TECHNICIEN))))
                               )
                             ),
                             DT::dataTableOutput("table"),
                             br(),br(),br()
                           )
                  ),
                  
                  # Deuxième page
                  tabPanel("Stat nombre Ticket",
                           fluidPage(
                             div(class = "centered-title", titlePanel("Analyse du nombre de ticket sur la plateforme")),
                             # Ajoutez ici votre code pour la visualisation (graphiques, etc.)
                             
                             sidebarLayout(
                               sidebarPanel(
                                 dateRangeInput("dates", h3("Période : "), start = "2022-01-01"),
                                 
                                 checkboxGroupInput("checkEtat", h3("Sélection Etat ticket :"), 
                                             choices = c("En attente", "Ouvert", "En cours de traitement", "Fermé"), selected = c("En attente", "Ouvert", "En cours de traitement", "Fermé")),
                                 
                                 checkboxGroupInput("checkGroup", 
                                                    h3("Sélection de statistique :"), 
                                                    choices = c("Moyenne", "Mediane", "Écart type")),
                                 
                                 actionButton("reset_button", "Réinitialiser")
                               ),
                               mainPanel(
                                 plotOutput("bar_chart"),
                                 textOutput("total_row"),
                                 textOutput("moyenne_ticket"),
                                 textOutput("mediane_ticket"),
                                 textOutput("sd_ticket")
                               )
                             )
                           )
                  )
                ))


# Définir le serveur ===================================================================================================================================
server <- function(input, output, session) {
  
  # Filtrer les données en fonction des sélections de l'utilisateur
  output$table <- DT::renderDataTable({
    data_filtrees <- data
    if (input$titre != "All") {
      data_filtrees <- data_filtrees[data_filtrees$TITRE_TICKET == input$titre,]
    }
    if (input$idtech != "All") {
      data_filtrees <- data_filtrees[data_filtrees$ID_TECHNICIEN == input$idtech,]
    }
    if (input$etat != "All") {
      data_filtrees <- data_filtrees[data_filtrees$ETAT_TICKET == input$etat,]
    }
    DT::datatable(data_filtrees)
  })
  
  # Fonction pour générer le DataFrame réactif
  generate_data <- reactive({
    start_date <- input$dates[1]
    end_date <- input$dates[2]
    
    data %>%
      filter(!is.na(Mois) & !is.na(Année) & 
               between(HORODATAGE_CREATION_TICKET, start_date, end_date) &
                  ETAT_TICKET %in% input$checkEtat) %>%
      
      group_by(Mois, Année) %>%
      summarise(Count = n(),  .groups = 'drop')
  })
  
  # Fonction pour générer et afficher le diagramme en temps réel
  output$bar_chart <- renderPlot({
    
    gg <- ggplot(generate_data(), aes(x = Mois, y = Count, fill = factor(Année))) +
      geom_bar(stat = "identity", position = "dodge") +
      geom_text(aes(label = Count), position = position_dodge(width = 1), vjust = -0.5) +
      labs(title = "Nombre de Tickets par Mois et Année")
    
    if ("Moyenne" %in% input$checkGroup) {
      moyenne_total_tickets <- moy1(generate_data()$Count)
      gg <- gg + geom_hline(yintercept = moyenne_total_tickets, color = "blue")
    }
    
    if ("Mediane" %in% input$checkGroup) {
      mediane_total_tickets <- median(generate_data()$Count)
      gg <- gg + geom_hline(yintercept = mediane_total_tickets, color = "orange")
    }
    
    if ("Écart type" %in% input$checkGroup) {
      sd_total_tickets <- sd1(generate_data()$Count)
      gg <- gg + geom_hline(yintercept = sd_total_tickets, color = "red")
    }
    
    print(gg)
  })
  
  output$total_row <- renderText({
    text <- ""
    nombre_total_tickets <- sum(generate_data()$Count)
    text <- paste(text, paste("Nombre total de tickets sélectionné : ", nombre_total_tickets))
  })
  
  
  output$moyenne_ticket <- renderText({
    text <- ""
    
    if ("Moyenne" %in% input$checkGroup) {
      moyenne_total_tickets <- moy1(generate_data()$Count)
      text <- paste(text, paste("Moyenne : ", round(moyenne_total_tickets, 2), id = "moyenne_ticket"))
    }
    
    return(text)
  })
  output$mediane_ticket <- renderText({
    text <- ""
    
    if ("Mediane" %in% input$checkGroup) {
      mediane_total_tickets <- median(generate_data()$Count)
      text <- paste(text, paste("Médiane : ", round(mediane_total_tickets, 2)), id = "mediane_ticket")
    }
    
    return(text)
  })
  
  output$sd_ticket <- renderText({
    text <- ""
    
    if ("Écart type" %in% input$checkGroup) {
      sd_total_tickets <- sd1(generate_data()$Count)
      text <- paste(text, paste("Écart type : ", round(sd_total_tickets, 2)), id = "sd_ticket")
    }
    
    return(text)
  })
  
  # Observer le bouton reset_button pour réinitialiser les inputs
  observeEvent(input$reset_button, {
    updateDateRangeInput(session, "dates", start = "2022-01-01", end = format(Sys.Date(), "%Y-%m-%d"))
    updateCheckboxGroupInput(session, "checkEtat", selected = c("En attente", "Ouvert", "En cours de traitement", "Fermé"))
    updateCheckboxGroupInput(session, "checkGroup", selected = character(0))
  })
}

# Lancer l'application
shinyApp(ui, server)

```
