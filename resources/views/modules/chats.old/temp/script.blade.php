<script>
    window.addEventListener('DOMContentLoaded', () => {
        const toggle = document.getElementById('chat-toggle');
        const button = toggle.querySelector('button');
        const loader = document.getElementById('chat-button-loader');
        const label = document.getElementById('btn-name');

        loader.style.display = 'none';
        button.disabled = false;
        label.textContent = 'Live Portal Chat';
    });

</script>
