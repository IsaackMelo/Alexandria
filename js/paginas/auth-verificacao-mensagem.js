        const caixinhas = document.querySelectorAll('.input-codigo');

        caixinhas.forEach((caixinha, indice) => {

            caixinha.addEventListener('input', () => {

                if (
                    caixinha.value.length === 1 &&
                    indice < caixinhas.length - 1
                ) {
                    caixinhas[indice + 1].focus();
                }

            });

        });
    
