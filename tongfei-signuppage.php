
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link type="text/css" href="css/site.css" rel="stylesheet">
    <title>SIGN UP / LOG IN</title>
    <style>
        .auth-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
            z-index: 10;
            margin-top:-150px;
        }

        .auth-box {
            background: rgba(0, 0, 0, 0.01);
            backdrop-filter: blur(2px);
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.01);
        }

        .auth-tabs {
            display: flex;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .auth-tab {
            flex: 1;
            padding: 15px;
            text-align: center;
            color: #888;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .auth-tab.active {
            color: white;
            border-bottom: 2px solid white;
        }

        .auth-form {
            display: none;
        }

        .auth-form.active {
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            color: #fff;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.15);
        }

        .auth-button {
            width: 100%;
            padding: 12px;
            background: white;
            color: black;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .auth-button:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }

        .auth-footer {
            margin-top: 20px;
            text-align: center;
            color: #888;
            font-size: 0.9rem;
        }

        .auth-footer a {
            color: white;
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<?php
//
//$host = "webdev.iyaserver.com";
//$userid = "<youruserid>";
//$userpw = "<yourpw>";
//$db = "<database name>";
//
//include 'loginvariables.php';
//
//
//$mysql = new mysqli(
//    $host,
//    $userid,
//    $userpw,
//    $db
//);
//
//if ($mysql->connect_errno) {
//    echo "db connection error : " . $mysql->connect_error;
//    exit();
//}
//
//echo "db connection succeeded\n";
//?>
<body>

<!-------------------------------<GLOBE FOR FUN>------------------------------------->

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


<!-------------------------------<MAIN BODY>------------------------------------->

<div>
    <?php include "header.php"; ?>

    <!-------------------------------<login/signup>------------------------------------->
    <section class="hero">
        <div class="auth-container">
            <div class="auth-box">
                <div class="auth-tabs">
                    <div class="auth-tab active" onclick="switchTab('login')">Log In</div>
                    <div class="auth-tab" onclick="switchTab('signup')">Sign Up</div>
                </div>
                <!-- Replace both form tags and the submit buttons with this: -->

                <form class="auth-form active" id="login-form">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-input">
                    </div>
                    <a href="homepage.php" class="auth-button" style="text-align: center; display: block; text-decoration: none;">Log In</a>
                    <div class="auth-footer">
                        <a href="#">Forgot password?</a>
                    </div>
                </form>

                <form class="auth-form" id="signup-form">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-input">
                    </div>
                    <a href="homepage.php" class="auth-button" style="text-align: center; display: block; text-decoration: none;">Sign Up</a>
                </form>
            </div>
        </div>
    </section>


    <!-------------------------------<CURSOR DYNAMIC>------------------------------------->
    <div class="cursor"></div>
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


    <!-------------------------------<login>------------------------------------->

    <script>
        function switchTab(tab) {
            // Remove active class from all tabs and forms
            document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.auth-form').forEach(f => f.classList.remove('active'));

            // Add active class to selected tab and form
            if(tab === 'login') {
                document.querySelector('#login-form').classList.add('active');
                document.querySelectorAll('.auth-tab')[0].classList.add('active');
            } else {
                document.querySelector('#signup-form').classList.add('active');
                document.querySelectorAll('.auth-tab')[1].classList.add('active');
            }
        }
    </script>

    <footer>
        <p>SafeCircle &nbsp;|&nbsp; Los Angeles, California &nbsp;|&nbsp; 2024 All Rights Reserved</p>
    </footer>
</div>

</body>
</html>

