import sys
from gradio_client import Client
import io

class StdoutInterceptor(io.TextIOWrapper):
    def write(self, s):
        s = s.replace('✔', '')
        return super().write(s)

old_stdout = sys.stdout
sys.stdout = StdoutInterceptor(old_stdout.buffer, encoding='utf-8')

if len(sys.argv) > 1:
    url_photo = sys.argv[1]  # Obtiene la URL de la foto desde los argumentos de la línea de comando

client = Client("https://jiawei011-dreamgaussian.hf.space/--replicas/tx3jw/")
result = client.predict(
    url_photo,  # Usa la URL obtenida de los argumentos
    True,
    0,
    fn_index=2
)
print(result)

sys.stdout = old_stdout
