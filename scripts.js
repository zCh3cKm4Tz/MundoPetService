document.addEventListener('DOMContentLoaded', () => {
    const registroForm = document.getElementById('registro-form');
    
    if (registroForm) {
        registroForm.addEventListener('submit', async (event) => {
            event.preventDefault(); // Impede o comportamento padrão do formulário

            const formData = new FormData(registroForm);  // Coleta os dados do formulário

            try {
                // Fazendo a requisição POST para o caminho absoluto do registro.php
                const response = await fetch('http://www.mundopetservice.com.br/registro.php', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`Erro na requisição: ${response.status}`);
                }

                const data = await response.text();
                console.log("Resposta do servidor:", data);

                if (data.includes('sucesso')) {
                    alert('Cadastro realizado com sucesso!');
                    window.location.href = 'login.html'; // Redireciona para a página de login
                } else {
                    alert('Erro ao cadastrar: ' + data);
                }
            } catch (error) {
                console.error('Erro:', error);
                alert('Erro durante o envio: ' + error.message);
            }
        });
    }
});
