
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link type="text/css" href="css/site.css" rel="stylesheet">
    <title>SafeCircle - Connect, Discover, and Share</title>
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
<body  onload="hideLoadingScreen()">

<!------------------------------------------ Loading Screen ------------------------------------------>
<div id="loading-screen">
    <img src="images/loading.gif" alt="Loading..." class="loading-gif">
</div>
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
<script>
    function hideLoadingScreen() {
        setTimeout(function() {

            document.getElementById("loading-screen").style.opacity = "0";
            document.getElementById("content").style.display = "block";
            document.getElementById("content").style.opacity = "1";
            //document.getElementById("loading-screen").style.display = "none";
        }, 2000); // Adjust the delay in milliseconds (2000 ms = 2 seconds)

        setTimeout(function() {
            document.getElementById("loading-screen").style.display = "none";
        }, 2700);
    }
</script>
<!------------------------------------------ Loading Screen ------------------------------------------>

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




<!----------------------CONTENT (wrapped in div)---------------------->

<div id="content" style="display:none;">
<?php include "header.php"; ?>

    <section class="hero">
        <br><br><br><br><br><br><br><br>

        <h1 class="tagline">Discover New Friends and Events – <br>
            Find Your Safe Circle for Every Adventure</h1>
        <button onclick="window.location.href='signuppage.php'" class="rounded-button">Join Now</button>
        <br>
        <!--DOWN ARROW SCROLL BUTTON TEST-->
        <img class="arrow" src="images/arrow.png" alt="pic of arrow" onClick="document.getElementById('concerts').scrollIntoView({ behavior: 'smooth' });" />

        <br><br><br>
    </section>

    <section class="section" id="concerts">

        <h3>DISCOVER EVENTS</h3><br>
        <button onclick="window.location.href='searchresult.php'" class="rounded-button">Find Events</button>
    </section>

    <div class="hover-gallery">
        <img src="images/galleryphotos/party1.gif" alt="placeholder">
        <img src="images/galleryphotos/party2.gif" alt="placeholder">
        <img src="images/galleryphotos/party3.gif" alt="placeholder">
        <img src="images/galleryphotos/party4.gif" alt="placeholder">
    </div>

    <section class="section" id="friends">
        <h3>MEET FRIENDS</h3><br>
        <button onclick="alert('FIND FRIENDS (COMING SOON)')" class="rounded-button">Find Friends</button>
    </section>

<!-- (GONNA TRY TO FIX THIS - TONGFEI)
    <div class="hover-gallery">
        <img src="images/banners/banner.png" alt="placeholder">
        <img src="images/banners/banner.png" alt="placeholder">
        <img src="images/banners/banner.png" alt="placeholder">
        <img src="images/banners/banner.png" alt="placeholder">
    </div>
-->
    <section class="section" id="events">
        <h3>MAKE MEMORIES</h3><br>
        <button onclick="alert('LOGIN PAGE')" class="rounded-button">Join SafeCircle</button>
    </section>

<!-- (GONNA TRY TO FIX THIS - TONGFEI)
    <div class="hover-gallery">
        <img src="images/banners/banner.png" alt="placeholder">
        <img src="images/banners/banner.png" alt="placeholder">
        <img src="images/banners/banner.png" alt="placeholder">
        <img src="images/banners/banner.png" alt="placeholder">
    </div>
-->

<!--------------------HOVER GALLERY CODE---------------------->
    <script>
        const heading = document.querySelector('h3');
        const gallery = document.querySelector('.hover-gallery');

        heading.addEventListener('mouseenter', () => {
            gallery.classList.add('visible');
        });

        heading.addEventListener('mouseleave', () => {
            gallery.classList.remove('visible');
        });

        document.addEventListener('mousemove', (e) => {
            const offset = -250; // Distance from cursor
            gallery.style.left = `${e.clientX + offset}px`;
            gallery.style.top = `${e.clientY + offset}px`;
        });
    </script>


    <script>
        const heading2 = document.querySelector('#friends');
        const gallery2 = document.querySelector('.hover-gallery');

        heading2.addEventListener('mouseenter', () => {
            gallery2.classList.add('visible');
        });

        heading2.addEventListener('mouseleave', () => {
            gallery2.classList.remove('visible');
        });

        document.addEventListener('mousemove', (e) => {
            const offset = -250; // Distance from cursor
            gallery2.style.left = `${e.clientX + offset}px`;
            gallery2.style.top = `${e.clientY + offset}px`;
        });
    </script>

    <script>
        const heading3 = document.querySelector('#events');
        const gallery3 = document.querySelector('.hover-gallery');

        heading3.addEventListener('mouseenter', () => {
            gallery2.classList.add('visible');
        });

        heading3.addEventListener('mouseleave', () => {
            gallery2.classList.remove('visible');
        });

        document.addEventListener('mousemove', (e) => {
            const offset = -250; // Distance from cursor
            gallery3.style.left = `${e.clientX + offset}px`;
            gallery3.style.top = `${e.clientY + offset}px`;
        });
    </script>
<!--------------------HOVER GALLERY CODE---------------------->

    <section class="section" id="join">
        <h2>FIND YOUR SAFECIRCLE</h2>
        <br>
        <button onclick="window.location.href='signuppage.php'" class="rounded-button" >Join Now</button>
    </section>

    <footer>
        <p>SafeCircle &nbsp;|&nbsp; Los Angeles, California &nbsp;|&nbsp; 2024 All Rights Reserved</p>
    </footer>
</div>

</body>
</html>

