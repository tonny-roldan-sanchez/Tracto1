# Guía de Respaldos de Base de Datos

## ¿Cómo funcionan los dos botones?

### 1. **Generar Respaldo**
- **Ubicación**: En el Dashboard (Panel), en la barra superior
- **Función**: Crea un archivo SQL con toda la base de datos
- **Proceso**:
  1. Haz clic en el botón "Generar Respaldo"
  2. El sistema creará un archivo SQL con un timestamp (ej: `respaldo_tracto_pension_2026-05-29_14-30-45.sql`)
  3. El archivo se descargará automáticamente en tu carpeta de descargas
  4. Se mostrará un mensaje de confirmación

### 2. **Importar Respaldo**
- **Ubicación**: En el Dashboard (Panel), en la barra superior
- **Función**: Restaura la base de datos desde un archivo SQL
- **Proceso**:
  1. Haz clic en el botón "Importar Respaldo"
  2. Se abrirá un selector de archivos
  3. Selecciona un archivo `.sql` (máximo 100MB)
  4. **⚠️ Importante**: Se pedirá confirmación. Esto sobrescribirá los datos actuales
  5. El sistema importará el contenido del archivo a la base de datos
  6. Se mostrará un mensaje de confirmación

## Requisitos Técnicos

Para que los respaldos funcionen, necesitas:

1. **MySQL/MariaDB instalado** en tu servidor (normalmente viene con Laragon)
2. **Acceso a los comandos**:
   - `mysqldump`: Para generar respaldos
   - `mysql`: Para importar respaldos
3. **Archivo `env.php` configurado** con los datos de la base de datos (ya está hecho)
4. **Permisos de escritura** en el directorio raíz del proyecto

## Archivos Creados

```
controllers/BackupController.php  → Lógica de respaldos
api/backup.php                     → Endpoint para procesar solicitudes
```

## Ubicación de Archivos

- **Respaldos generados**: Se guardan en el raíz del proyecto (ej: `respaldo_tracto_pension_2026-05-29_14-30-45.sql`)
- **Respaldos importados temporales**: Se guardan en la carpeta `respaldos/` (se eliminan automáticamente después de importar)

## Seguridad

✓ Los archivos se validan (extensión .sql)
✓ Se verifica el tamaño máximo (100MB)
✓ Se pide confirmación antes de importar
✓ Se usan comandos seguros del sistema

## Solución de Problemas

### "Error: mysqldump no encontrado"
- Verifica que MySQL esté instalado
- En Windows con Laragon, los binarios están en: `C:\laragon\bin\mysql\`
- Agrega esa ruta a las variables de entorno del sistema

### "Error: Acceso denegado"
- Verifica que los datos en `env.php` sean correctos
- Comprueba que el usuario de MySQL tiene permisos

### "Error: El archivo de respaldo no fue creado"
- Verifica permisos de escritura en el directorio raíz
- Intenta crear una carpeta manualmente en el raíz del proyecto

## Frecuencia Recomendada de Respaldos

- **Diaria**: Si la aplicación tiene cambios frecuentes
- **Semanal**: Si hay cambios moderados
- **Antes de cambios importantes**: Antes de actualizaciones o migraciones

---

✅ Los botones ya están funcionales y listos para usar en el Dashboard
