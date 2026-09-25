# chain-spectator

Tinc ganes de fer un projecte amb Slim4 i HTMX i no m'agrada el stack tecnològic de mempol
ni la cara dels seus devs, així que proposo reimplementar-lo fent servir el seu repo com a referència.

Abans de picar ni una línia de codi hem de cremar tokens especificant quines vistes volem implementar.
Segurament té sentit definir fites per al projecte, com ara "aquestes son les vistes i funcionalitats
que ha de tenir la primera fita, etc.

El repositori original està afegit com a submòdul a `references/mempool` per a que el puguis analitzar.

## Fases

1. Especificar fites del projecte a nivell de wireframe i funcionalitats a implementar, expandint el
   scope del projecte gradualment. Produïr documentació i dissenys a `docs`
2. Estudiar el codi de referència com a guia per prendre decisions arquitectòniques o simplement com a inspiració.
   Produïr documentació que expliqui com funciona el repo de mempool a `docs`.
3. Implementació de les fases en un stack tecnològic de PHP+Slim4 al backend i HTMX al frontend, intentant mantenir
   el frontend stateless i sense gaire o gens de javascript. A llarg termini el backend podria canviar per fer més
   fàcil l'empaquetament de l'aplicació o suportar funcionalitat basada en Websockets o SSE.

## Constraints

Tot el codi i la documentació ha de ser en anglès. El català es limita a aquest fitxer perquè és l'idioma que
faig servir per interactuar amb agents.

### Desenvolupament

Basat en Compose i contenidors de Docker.
L'aplicació no ha d'estar acoblada a Docker, en el sentit que ha de ser fàcil de córrer fora de Docker.

### Backend

PHP 8.5 FPM, projecte Composer, Slim 4, middlewares i controladors PSR-15, contenidor de dependències PHP-DI, plantilles Twig.
Servidor web: Caddy
Bitcoin: Bitcoin Knots v29 RPC en mode Regtest o Signet
Electrum: Fulcrum RPC
Bases de dades: MariaDB si cal una BD relacional, Redis si cal una KV, o APCu del propi php-fpm quan tingui sentit.
API: caldrà alguna font de preus històrics de Bitcoin.

### Frontend

HTMX, sense JS ni passos de compilació a ser possible. Mantenir la filosofia HATEOAS al màxim possible.
