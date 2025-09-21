<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programacion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="examen.php">Examen</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="preguntas.php">Preguntas</a>
        </li>
        
        
        
      </ul>
    </div>
  </div>
</nav>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <h2 class="display-4">Programacion</h2>
            </div>
        </div>
    </div>

<br>
<div>
 
  <label for="cantidad">Cantidad de preguntas a sortear:</label>
  <input type="number" id="cantidad" min="1">
  <button onclick="sortear()">Sortear</button>
  <br>
  <br>

  <h3>Preguntas Seleccionadas:</h3>
  <ul id="resultado"></ul>

  <script>
    
    const preguntas = [
      "¿Qué es la programación informática?",
      "¿Cómo funciona la programación?",
      "¿Qué es la depuración?",
      "¿Qué significa HTML?",
      "¿Cuándo ocurre un error de sintaxis?",
      "¿Qué es un diagrama de flujo?",
      "¿Qué es una variable en programación?"
    ];

    function sortear() {
      const cantidad = parseInt(document.getElementById("cantidad").value);
      const resultado = document.getElementById("resultado");
      resultado.innerHTML = "";

      if (isNaN(cantidad) || cantidad < 1) {
        alert("Por favor, ingrese un número válido.");
        return;
      }

      if (cantidad > preguntas.length) {
        alert("No puedes pedir más preguntas de las que existen.");
        return;
      }


      let disponibles = [...preguntas];
      let seleccionadas = [];

      for (let i = 0; i < cantidad; i++) {
        const indice = Math.floor(Math.random() * disponibles.length);
        seleccionadas.push(disponibles[indice]);
        disponibles.splice(indice, 1); 
      }


      seleccionadas.forEach(p => {
        let li = document.createElement("li");
        li.textContent = p;
        resultado.appendChild(li);
      });
    }
  </script>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="app.js"></script>
</body>
</html>