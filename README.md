
# Security Intelligence Platform

Plateforme interne de monitoring et de sécurité destinée à centraliser les événements de sécurité, la supervision des endpoints, la détection, le Threat Intelligence et les capacités de Threat Hunting.

## Architecture

Le projet est organisé en plusieurs composants :

- `backend/` — API et logique serveur Laravel
- `frontend/` — interface web React / Next.js
- `agent/` — agent endpoint développé en Go
- `docs/` — documentation technique et architecture
- `docker/` — configuration liée à la conteneurisation
- `.github/` — workflows GitHub Actions

## Environnement de développement

L'environnement de développement utilise Docker Compose pour exécuter Laravel et PostgreSQL.

### Prérequis

- Docker
- Docker Compose (intégré à Docker sous forme de plugin)

### Configuration initiale

À la racine du projet, créer le fichier `.env` à partir du modèle :

```bash
cp .env.example .env
```

Modifier ensuite `POSTGRES_PASSWORD` dans `.env` pour définir un mot de passe local.

Le fichier `.env` contient des informations sensibles et ne doit jamais être ajouté à Git.

### Démarrer l'application

Pour construire les images et démarrer les conteneurs :

```bash
docker compose up -d --build
```

L'option `-d` lance les conteneurs en arrière-plan.

L'option `--build` reconstruit l'image de l'application si nécessaire.

### Vérifier l'état des conteneurs

```bash
docker compose ps
```

Le service PostgreSQL doit afficher l'état `healthy`.

### Accéder à l'application

- Application Laravel : http://localhost:8001
- PostgreSQL : `localhost:5433`

Le port PostgreSQL est exposé uniquement sur l'interface locale de la machine.

### Consulter les logs

Pour afficher les logs des services :

```bash
docker compose logs -f
```

Pour afficher uniquement les logs de Laravel :

```bash
docker compose logs -f app
```

Pour quitter l'affichage des logs : `Ctrl + C`.

### Exécuter les commandes Laravel

Les commandes Artisan doivent être exécutées dans le conteneur de l'application :

```bash
docker compose exec app php artisan migrate
```

Pour lancer les tests :

```bash
docker compose exec app php artisan test
```

### Arrêter l'application

Pour arrêter les conteneurs sans supprimer les données :

```bash
docker compose stop
```

Pour redémarrer les conteneurs arrêtés :

```bash
docker compose start
```

Il est également possible d'arrêter et de supprimer les conteneurs et le réseau du projet :

```bash
docker compose down
```

Cette commande conserve le volume PostgreSQL.

**Attention :** ne pas utiliser `docker compose down -v` dans l'environnement de développement sans comprendre les conséquences. L'option `-v` supprime les volumes associés et peut entraîner la perte des données PostgreSQL.

### Persistance PostgreSQL

Les données PostgreSQL sont conservées dans le volume Docker :

`sip_postgres_data`

Le volume permet de conserver les données même après l'arrêt ou la recréation du conteneur PostgreSQL.

## Version

Projet en phase d'initialisation — v0.1.
