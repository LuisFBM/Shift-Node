document
  .getElementById("filtroAgendamento")
  .addEventListener("keyup", function () {
    const filtro = this.value.toLowerCase();
    const linhas = document.querySelectorAll("#tabelaAgendamentos tbody tr");

    linhas.forEach((linha) => {
      const data = linha.cells[3].textContent.toLowerCase();
      const hora = linha.cells[4].textContent.toLowerCase();
      const status = linha.cells[6].textContent.toLowerCase();

      if (
        data.includes(filtro) ||
        hora.includes(filtro) ||
        status.includes(filtro)
      ) {
        linha.style.display = "";
      } else {
        linha.style.display = "none";
      }
    });
  });
