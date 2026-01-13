# Chasme CRM: Sistema de Gestión Impulsado por Voz e IA 🎙️🤖

**Chasme** es un ecosistema inteligente que redefine la gestión de clientes y créditos (CRM). A diferencia de los sistemas tradicionales, Chasme permite interactuar con los datos mediante lenguaje natural gracias a un sistema híbrido que combina la robustez de **Laravel**, la flexibilidad de **Python**, la orquestación de **n8n** y la potencia de la IA **Google Gemini**.

---

## 🚀 Arquitectura del Proyecto

El sistema se divide en tres capas principales que trabajan en perfecta armonía:

### 1. El Cerebro: n8n + AI (Gemini)
El motor del sistema reside en un flujo de trabajo de **n8n**. 
- **Interpretación**: Recibe el texto transcrito de la voz.
- **IA (Gemini)**: Actúa como cerebro procesador, entendiendo la intención del usuario (ej: "Añade un pago de 50 mil a Jaime").
- **Lógica**: Realiza cálculos, busca en la base de datos y decide qué acción ejecutar en el CRM.

### 2. El Interfaz: Laravel CRM
Un panel administrativo moderno construido en **Laravel 10** que sirve como repositorio central de la información:
- **Gestión de Clientes**: Seguimiento detallado, histórico y estados.
- **Módulo de Créditos**: Control de pagos, deudas y cargos.
- **Tareas y Notificaciones**: Sistema de seguimiento automático.
- **Seguridad**: Gestión de roles y permisos granulares.

### 3. El Sensor local: Asistente Python
Un script ligero de **Python** diseñado para correr en cualquier lugar (**Termux en Android, Linux, Windows, macOS**).
- **Escucha Activa**: Utiliza reconocimiento de voz de alta precisión.
- **Portabilidad**: Perfecto para ser usado en tablets o teléfonos en terreno (ideal para conductores o agentes de venta).
- **Feedback**: Sistema de vibración y sonidos para confirmar que la IA ha recibido la instrucción correctamente sin necesidad de mirar la pantalla.

---

## 🛠️ Tecnologías Utilizadas

- **Backend**: Laravel 10 (PHP 8.1+)
- **Base de Datos**: MySQL / MariaDB
- **Asistente**: Python 3.x (SpeechRecognition, Requests, Dotenv)
- **Automatización**: n8n
- **IA**: Google Gemini (vía API)
- **Diseño**: Estética Premium con Glassmorphism y Bootstrap 5

---

## 🔧 Configuración del Asistente Python (Tablet/PC)

Para ejecutar el asistente de voz en cualquier dispositivo:

1.  **Instalar dependencias**:
    ```bash
    pip install speech_recognition requests python-dotenv
    ```
2.  **Configurar Variable de Entorno**:
    Crea un archivo [.env](cci:7://file:///root/chasme/chasme/chasme/.env:0:0-0:0) en la carpeta del script con tu URL de webhook de n8n:
    ```text
    PYTHON_N8N_WEBHOOK_URL=[https://tu-instancia-ia.cl/webhook/tu-id](https://tu-instancia-ia.cl/webhook/tu-id)
    ```
3.  **Ejecutar**:
    ```bash
    python asistente_n8n.py
    ```

---

## 🔒 Seguridad
Este proyecto sigue las mejores prácticas de seguridad de Laravel:
- Todas las URLs, claves de API y credenciales están gestionadas mediante archivos [.env](cci:7://file:///root/chasme/chasme/chasme/.env:0:0-0:0).
- Protección CSRF y sanitización de datos en todos los puntos de entrada.
- Sistema de permisos para asegurar que solo usuarios autorizados realicen cambios sensibles.

---

## 👨‍💻 Contribución y Desarrollo
Proyecto desarrollado por **Telcored**. 

Diseñado para facilitar la vida de quienes trabajan en movimiento, transformando la voz en datos estructurados y decisiones inteligentes.
