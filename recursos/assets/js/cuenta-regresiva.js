const deadline = new Date("Dec 31, 2025 23:59:59").getTime();

const x = setInterval(function() {
    const now = new Date().getTime();
    const distance = deadline - now;

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Asegúrate de que estos IDs existan en tu HTML
    const elDias = document.getElementById("dias");
    const elHoras = document.getElementById("horas");
    const elMinutos = document.getElementById("minutos");
    const elSegundos = document.getElementById("segundos");

    // Verificación de seguridad para evitar errores si cambias de página
    if (elDias && elHoras && elMinutos && elSegundos) {
        elDias.innerHTML = days < 10 ? "0" + days : days;
        elHoras.innerHTML = hours < 10 ? "0" + hours : hours;
        elMinutos.innerHTML = minutes < 10 ? "0" + minutes : minutes;
        elSegundos.innerHTML = seconds < 10 ? "0" + seconds : seconds;
    }

    if (distance < 0) {
        clearInterval(x);
        const aviso = document.querySelector(".voting-deadline p");
        if(aviso) aviso.innerHTML = "¡VOTACIONES CERRADAS!";
    }
}, 1000);