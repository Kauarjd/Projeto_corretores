document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('corretorForm');
    
    form.addEventListener('submit', function(e) {
        let valid = true;
        
        // Validação do CPF
        const cpf = document.getElementById('cpf');
        if (cpf.value.length !== 11 || !/^\d+$/.test(cpf.value)) {
            alert('CPF deve conter exatamente 11 dígitos numéricos.');
            valid = false;  
        }
        
        // Validação do CRECI
        const creci = document.getElementById('creci');
        if (creci.value.trim().length < 2) {
            alert('CRECI deve ter pelo menos 2 caracteres.');
            valid = false;
        }
        
        // Validação do Nome
        const nome = document.getElementById('nome');
        if (nome.value.trim().length < 2) {
            alert('Nome deve ter pelo menos 2 caracteres.');
            valid = false;
        }
        
        if (!valid) {
            e.preventDefault();
        }
    });
});