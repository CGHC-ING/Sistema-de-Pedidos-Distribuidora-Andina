# Prueba técnica · Sistema de pedidos de Distribuidora Andina

Distribuidora Andina S.A.S. es una distribuidora mayorista de productos de ferretería y aseo. Hoy toma sus pedidos en hojas de cálculo y por correo, y necesita una aplicación web interna para gestionar clientes, productos, pedidos, inventario y pagos.

Tu reto es **construir esa aplicación** a partir del documento de requerimientos.

| | |
| --- | --- |
| **Tiempo** | 3 días |
| **Tecnología** | PHP 8.2 sin framework, MySQL 8.0, Bootstrap 5 y Docker |
| **Despliegue** | En AWS, con tu propia cuenta |

## Documentos

| Archivo | Qué contiene |
| --- | --- |
| [`docs/Requerimientos_Aplicativo_Pedidos.pdf`](docs/Requerimientos_Aplicativo_Pedidos.pdf) | Requerimientos completos: alcance, roles, reglas de negocio, requerimientos funcionales y no funcionales, modelo de datos, datos de prueba, despliegue y entregables. |
| [`docs/Requerimientos_Aplicativo_Pedidos.docx`](docs/Requerimientos_Aplicativo_Pedidos.docx) | El mismo documento en Word. |
| [`docs/Diagramas_Aplicativo_Pedidos.html`](docs/Diagramas_Aplicativo_Pedidos.html) | Modelo de datos de referencia y diagrama de casos de uso. Ábrelo en el navegador. |

Lee el documento completo antes de empezar. Las **reglas de negocio (sección 4)** definen cómo se calculan descuentos, IVA y totales, y cómo se mueve el inventario: son la base de la evaluación.

## Cómo empezar

1. Crea tu propio repositorio a partir de este, por ejemplo con **Use this template** en GitHub, o clonándolo y subiéndolo a tu cuenta.
2. Trabaja con commits pequeños y mensajes en español: el historial también se revisa.
3. Usa la estructura sugerida o ajústala a tu criterio, explicando el cambio en el README.

## Estructura sugerida

```
├── db/
│   └── init/           Scripts SQL: esquema y datos de prueba
├── docs/               Documentos de la prueba (no los modifiques)
├── public/             Raíz web
│   ├── includes/       Conexión, sesión y permisos, plantilla y funciones comunes
│   ├── clientes/
│   ├── productos/
│   ├── pedidos/
│   ├── pagos/
│   └── reportes/
├── .env.example        Variables de entorno, sin valores reales
├── docker-compose.yml
├── Dockerfile
└── README.md
```

## Qué entregar

El detalle está en la sección 11 del documento. En resumen:

- El repositorio con el código y su historial de commits.
- `Dockerfile` y `docker-compose.yml`: el proyecto debe levantar con `docker compose up -d` en `http://localhost:8080`.
- Los scripts de `db/init/` con el esquema y los datos de prueba.
- Un `.env.example` sin valores reales.
- La aplicación publicada en AWS, con su URL.
- Este README reemplazado por el de tu proyecto, con:
  - cómo levantarlo y las variables de entorno;
  - los usuarios de prueba;
  - tus decisiones de diseño y supuestos;
  - lo que haya quedado pendiente;
  - la URL de AWS y cómo lo desplegaste.

Al terminar, comparte el acceso a tu repositorio con la persona que te envió la prueba.

> El despliegue en AWS se hace con tu propia cuenta. Revisa las condiciones gratuitas vigentes, configura una alerta de presupuesto y no subas credenciales al repositorio.
