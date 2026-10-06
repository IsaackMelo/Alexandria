        function voltarPagina() {

            if (window.history.length > 1) {

                window.history.back();

            } else {

                window.location.href = "../web/index.php";

            }

        }

        if (!termos) {

                    alert(
                        "Você precisa aceitar os Termos de Uso e a Política de Privacidade."
                    );

                    return;

                }

    
