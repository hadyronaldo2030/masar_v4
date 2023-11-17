<!DOCTYPE html>
<html>
<head>
  <title>Error</title>

  <style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background: #22232e;
  font-family: 'Poppins', sans-serif;
}
.container .imgError {
  width: 420px;
  animation-name: float;
  animation: float 2s infinite;
}
@keyframes float {
      0% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-10px);
      }
      100% {
        transform: translateY(0);
      }
    }


.text {
  display: flex;
  padding: 40px 40px;
  align-items: center;
  flex-direction: column;
}
.text h1 {
  color: #00c2cb;
  font-size: 35px;
  font-weight: 900;
  margin-bottom: 15px;
}

  </style>
</head>
<body>
  <section>
    <div class="container">
     <div class="text">
      <img class="imgError" src="{{ asset($globalVariable . 'assets') }}/img/error503.png" alt="Error 503">
      <h1>Error Server</h1>
    </div>
  </div>
    </div>
</section>

</body>
</html>

