<!------------------------------------------ globe test ------------------------------------------>

<canvas class="webgl-globe" data-engine="three.js r148"></canvas>
<script type="importmap">
    {
        "imports": {
            "three": "https://unpkg.com/three@0.148.0/build/three.module.js"
        }
    }
</script>
<script type="module">
    import * as THREE from 'three';

    const canvas = document.querySelector('.webgl-globe');

    setTimeout(() => {
        canvas.style.opacity = '1';
    }, 100);

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 8;

    const renderer = new THREE.WebGLRenderer({
        canvas: canvas,
        antialias: true,
        alpha: true
    });
    renderer.setClearColor(0x000000, 0);
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    const particlesGeometry = new THREE.BufferGeometry();
    const particlesCount = 3000;
    const positions = new Float32Array(particlesCount * 3);
    const sparkleOffsets = new Float32Array(particlesCount);
    const sparkleSpeeds = new Float32Array(particlesCount);
    const radius = 2.5;

    for(let i = 0; i < particlesCount; i++) {
        const phi = Math.acos(-1 + (2 * i) / particlesCount);
        const theta = Math.sqrt(particlesCount * Math.PI) * phi;

        const jitter = 0.1;
        positions[i * 3] = radius * Math.cos(theta) * Math.sin(phi) + (Math.random() - 0.5) * jitter;
        positions[i * 3 + 1] = radius * Math.sin(theta) * Math.sin(phi) + (Math.random() - 0.5) * jitter;
        positions[i * 3 + 2] = radius * Math.cos(phi) + (Math.random() - 0.5) * jitter;

        sparkleOffsets[i] = Math.random() * Math.PI * 2;
        sparkleSpeeds[i] = 0.2 + Math.random() * 2; // Varied speeds for twinkling
    }

    particlesGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    particlesGeometry.setAttribute('sparkleOffset', new THREE.BufferAttribute(sparkleOffsets, 1));
    particlesGeometry.setAttribute('sparkleSpeed', new THREE.BufferAttribute(sparkleSpeeds, 1));

    const particlesMaterial = new THREE.ShaderMaterial({
        uniforms: {
            time: { value: 0 },
            fadeAmount: { value: 1.0 }
        },
        vertexShader: `
        attribute float sparkleOffset;
        attribute float sparkleSpeed;
        uniform float time;
        uniform float fadeAmount;
        varying float vBrightness;

        void main() {
            vec4 mvPosition = modelViewMatrix * vec4(position, 1.0);
            gl_Position = projectionMatrix * mvPosition;

            float sparkle = sin(time * sparkleSpeed + sparkleOffset) * 0.7 + 0.5;
            sparkle = pow(sparkle, 4.0);
            vBrightness = sparkle;
//THIS
            gl_PointSize = mix(0.049, 0.03, sparkle) * (300.0 / -mvPosition.z); // Adjust point size for brightness
        }
    `,
        fragmentShader: `
        varying float vBrightness;
        uniform float fadeAmount;

        void main() {
            vec2 center = gl_PointCoord - vec2(0.5);
            float dist = length(center);
            if(dist > 0.5) discard;

            float baseOpacity = 0.9;
            float maxOpacity = 1.5;
            float opacity = mix(baseOpacity, maxOpacity, pow(vBrightness, 3.0)) * fadeAmount;
            vec3 color = vec3(1.0, 1.0, 1.0);
            gl_FragColor = vec4(color, opacity);
        }
    `,
        transparent: true,
        blending: THREE.AdditiveBlending,
        depthWrite: false
    });

    const globe = new THREE.Points(particlesGeometry, particlesMaterial);
    scene.add(globe);

    const mouse = { x: 0, y: 0 };
    const target = { x: 0, y: 0 };
    const windowHalf = {
        x: window.innerWidth / 2,
        y: window.innerHeight / 2
    };

    document.addEventListener('mousemove', (event) => {
        mouse.x = (event.clientX - windowHalf.x) / windowHalf.x;
        mouse.y = (event.clientY - windowHalf.y) / windowHalf.y;
    });

    let currentScroll = 0;
    let targetScroll = 0;
    let scrollVelocity = 0;

    window.addEventListener('scroll', () => {
        targetScroll = window.scrollY / (document.body.offsetHeight - window.innerHeight);
    });

    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
        windowHalf.x = window.innerWidth / 2;
        windowHalf.y = window.innerHeight / 2;
    });

    let baseRotation = 0;
    const startTime = Date.now();

    function animate() {
        requestAnimationFrame(animate);

        const timeSinceStart = (Date.now() - startTime) / 1000;
        const fadeInProgress = Math.min(timeSinceStart / 2, 1);

        currentScroll += (targetScroll - currentScroll) * 0.05;
        scrollVelocity = (targetScroll - currentScroll) * 0.05;

        const maxZoom = 0.5;
        const zoomProgress = Math.min(currentScroll * 1.2, 1);
        const zoomDistance = 8 - (8 - maxZoom) * zoomProgress;

        const fadeThreshold = 0.6;
        let fadeOut = 1;
        if (zoomProgress > fadeThreshold) {
            fadeOut = 1 - ((zoomProgress - fadeThreshold) / (1 - fadeThreshold));
        }

        particlesMaterial.uniforms.time.value = Date.now() * 0.001;
        particlesMaterial.uniforms.fadeAmount.value = fadeInProgress * fadeOut;

        target.x = mouse.x * 0.5;
        target.y = mouse.y * 0.5;

        baseRotation += 0.001;

        const rotationSpeed = 1 + zoomProgress * 2;
        globe.rotation.y = baseRotation * rotationSpeed + (target.x - globe.rotation.y) * 0.05 + scrollVelocity;
        globe.rotation.x += (target.y - globe.rotation.x) * 0.05;

        camera.position.z = zoomDistance;
        camera.position.y = currentScroll * 1;
        camera.lookAt(scene.position);

        renderer.render(scene, camera);
    }

    animate();
</script>
<!------------------------------------------ globe test ------------------------------------------>