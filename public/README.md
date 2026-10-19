# public

Raíz web de la aplicación. Una organización posible:

| Carpeta | Contenido |
| --- | --- |
| `includes/` | Conexión a la base, sesión y permisos, plantilla común (encabezado y pie) y funciones compartidas, como el cálculo de totales |
| `clientes/` | Listar y buscar, crear, editar, desactivar |
| `productos/` | Listado paginado, crear, editar, desactivar |
| `pedidos/` | Listar, crear, ver detalle, confirmar, despachar, entregar, anular |
| `pagos/` | Registrar pagos |
| `reportes/` | Ventas del mes |

Los archivos `index.php`, `login.php` y `logout.php` van en la raíz de esta carpeta.
