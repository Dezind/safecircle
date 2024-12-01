<style>
    * {
        cursor: none;
    }
</style>

<script>

    document.addEventListener('mousemove', (e) => {
        document.body.style.setProperty('--x', e.clientX + 'px');
        document.body.style.setProperty('--y', e.clientY + 'px');
    });

    // Add click effect
    document.addEventListener('click', (e) => {
        createSparkles(e.clientX, e.clientY);
    });

    function createSparkles(x, y) {
        const sparkleCount = 8;

        for(let i = 0; i < sparkleCount; i++) {
            const sparkle = document.createElement('div');
            sparkle.className = 'sparkle';

            const size = Math.random() * 8 + 4;
            sparkle.style.width = `${size}px`;
            sparkle.style.height = `${size}px`;

            const angle = (Math.PI * 2 * i) / sparkleCount;
            const distance = Math.random() * 50 + 30;

            const tx = Math.cos(angle) * distance;
            const ty = Math.sin(angle) * distance;

            sparkle.style.left = `${x}px`;
            sparkle.style.top = `${y}px`;
            sparkle.style.setProperty('--tx', `${tx}px`);
            sparkle.style.setProperty('--ty', `${ty}px`);

            document.body.appendChild(sparkle);

            setTimeout(() => {
                sparkle.remove();
            }, 800);
        }
    }
</script>