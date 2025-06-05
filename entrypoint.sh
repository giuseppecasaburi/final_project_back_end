#!/bin/bash

# Crea il symlink se non esiste
php artisan storage:link || echo "Symlink già esistente o fallito"

# Avvia il server Laravel
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}