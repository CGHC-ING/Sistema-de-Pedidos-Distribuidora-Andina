# db/init

Scripts SQL que se ejecutan al crear la base de datos por primera vez, en orden alfabético. Por ejemplo:

- `01_schema.sql`: tablas, llaves e índices.
- `02_seed.sql`: datos de prueba (sección 9 del documento de requerimientos).

Con Docker, monta esta carpeta en `/docker-entrypoint-initdb.d` del contenedor de MySQL para que se carguen solos.
