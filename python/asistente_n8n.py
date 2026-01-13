import speech_recognition as sr
import requests
import json
import os
from dotenv import load_dotenv

# Cargamos las variables de entorno desde el archivo .env
load_dotenv()

# --- CONFIGURACIÓN ---
# La URL se lee desde el archivo .env para mayor seguridad
N8N_URL = os.getenv("PYTHON_N8N_WEBHOOK_URL")

def enviar_a_n8n(texto):
    payload = {
        "comando": texto,
        "dispositivo": "tablet_android",
        "idioma": "es-CL"
    }
    try:
        response = requests.post(N8N_URL, json=payload, timeout=10)
        print(f"Respuesta de N8N: {response.status_code}")

        # SI TODO SALE BIEN: Feedback para el conductor
        if response.status_code == 200:
            print("¡Datos enviados correctamente!")
            # Vibra y suena una campana (feedback auditivo)
            os.system('termux-vibrate -d 100')
            print("\a")

    except Exception as e:
        print(f"Error enviando a N8N: {e}")
        # Vibración larga en caso de error de conexión
        os.system('termux-vibrate -d 500')

def escuchar():
    r = sr.Recognizer()
    # Ajustamos la sensibilidad para que no se quede pegado con el ruido del motor
    r.dynamic_energy_threshold = True

    with sr.Microphone() as source:
        print("\n--- Sistema listo ---")
        print("Habla ahora...")

        # Ajuste al ruido de fondo (importante en un vehículo)
        r.adjust_for_ambient_noise(source, duration=0.8)

        try:
            # Escuchamos: timeout es cuánto tiempo espera silencio antes de empezar,
            # phrase_time_limit es duración máxima de la frase.
            audio = r.listen(source, timeout=20, phrase_time_limit=20)

            print("Traduciendo voz a texto...")
            # Usamos Google para mayor precisión en español de Chile
            texto = r.recognize_google(audio, language="es-CL")
            print(f"Texto detectado: '{texto}'")

            enviar_a_n8n(texto)

        except sr.WaitTimeoutError:
            print("No se detectó voz después de un tiempo.")
        except sr.UnknownValueError:
            print("No se pudo entender el audio (intenta hablar más claro).")
        except sr.RequestError as e:
            print(f"Error de conexión con el servicio de voz: {e}")
        except Exception as e:
            print(f"Error inesperado: {e}")

if __name__ == "__main__":
    # Bucle infinito para que el asistente esté siempre activo
    try:
        while True:
            escuchar()
    except KeyboardInterrupt:
        print("\nAsistente desactivado por el usuario.")