/**
 * Shri Mandir Trust - Divine Interactive Animation Engine
 * GSAP ScrollTrigger, Vedic Audio Synthesis, Sacred Particles & Micro-Interactions
 */

document.addEventListener('DOMContentLoaded', () => {
    initScrollProgressBar();
    initDivineParticlesCanvas();
    initGsapScrollAnimations();
    initCounterAnimations();
    initNavbarScrollEffects();
    initModalEvents();
});

/* -------------------------------------------------------------
 * 1. Top Sacred Reading Progress Bar
 * ------------------------------------------------------------- */
function initScrollProgressBar() {
    const bar = document.getElementById('reading-progress-bar');
    if (!bar) return;

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
        const progress = scrollHeight > 0 ? (scrollTop / scrollHeight) * 100 : 0;
        bar.style.width = `${progress}%`;
    }, { passive: true });
}

/* -------------------------------------------------------------
 * 2. GSAP & ScrollTrigger Animations
 * ------------------------------------------------------------- */
function initGsapScrollAnimations() {
    if (typeof gsap === 'undefined') return;
    
    if (typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
    }

    // Hero Section staggered entrance sequence
    const heroContent = document.querySelector('#hero-section .parchment-scroll');
    if (heroContent) {
        gsap.fromTo(heroContent, 
            { opacity: 0, y: 40, scale: 0.96 },
            { opacity: 1, y: 0, scale: 1, duration: 1.2, ease: "power3.out", delay: 0.1 }
        );
    }

    // Standard Fade-Up Elements
    const fadeUpElements = document.querySelectorAll('.fade-up, .reveal-fade-up');
    fadeUpElements.forEach((elem) => {
        gsap.fromTo(elem,
            { opacity: 0, y: 35 },
            {
                opacity: 1,
                y: 0,
                duration: 0.9,
                ease: "power2.out",
                scrollTrigger: {
                    trigger: elem,
                    start: "top 88%",
                    once: true
                }
            }
        );
    });

    // Left Slide-in Elements
    const fadeLeftElements = document.querySelectorAll('.reveal-fade-left');
    fadeLeftElements.forEach((elem) => {
        gsap.fromTo(elem,
            { opacity: 0, x: -45 },
            {
                opacity: 1,
                x: 0,
                duration: 1,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: elem,
                    start: "top 88%",
                    once: true
                }
            }
        );
    });

    // Right Slide-in Elements
    const fadeRightElements = document.querySelectorAll('.reveal-fade-right');
    fadeRightElements.forEach((elem) => {
        gsap.fromTo(elem,
            { opacity: 0, x: 45 },
            {
                opacity: 1,
                x: 0,
                duration: 1,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: elem,
                    start: "top 88%",
                    once: true
                }
            }
        );
    });

    // Scale-in Elements
    const scaleElements = document.querySelectorAll('.reveal-scale-in');
    scaleElements.forEach((elem) => {
        gsap.fromTo(elem,
            { opacity: 0, scale: 0.9 },
            {
                opacity: 1,
                scale: 1,
                duration: 0.9,
                ease: "back.out(1.4)",
                scrollTrigger: {
                    trigger: elem,
                    start: "top 90%",
                    once: true
                }
            }
        );
    });

    // Staggered Child Containers (Pooja lists, timeline entries, festival items)
    const staggerContainers = document.querySelectorAll('.stagger-parent');
    staggerContainers.forEach((container) => {
        const children = container.children;
        if (children.length > 0) {
            gsap.fromTo(children,
                { opacity: 0, y: 25 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    stagger: 0.15,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: container,
                        start: "top 85%",
                        once: true
                    }
                }
            );
        }
    });

    // Timeline Node Sequential Pop
    const timelineItems = document.querySelectorAll('.timeline-node');
    if (timelineItems.length > 0) {
        timelineItems.forEach((node, i) => {
            gsap.fromTo(node,
                { opacity: 0, x: -30 },
                {
                    opacity: 1,
                    x: 0,
                    duration: 0.8,
                    delay: i * 0.1,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: node,
                        start: "top 90%",
                        once: true
                    }
                }
            );
        });
    }
}

/* -------------------------------------------------------------
 * 3. Animated Number Counters
 * ------------------------------------------------------------- */
function initCounterAnimations() {
    const counterElements = document.querySelectorAll('[data-counter-target]');
    if (counterElements.length === 0) return;

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.getAttribute('data-counter-target'), 10);
                const prefix = el.getAttribute('data-counter-prefix') || '';
                const suffix = el.getAttribute('data-counter-suffix') || '';
                const duration = 2000; // 2 seconds
                let startTimestamp = null;

                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    // Ease out expo
                    const easeProgress = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                    const currentVal = Math.floor(easeProgress * target);
                    
                    el.textContent = `${prefix}${currentVal.toLocaleString()}${suffix}`;

                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    } else {
                        el.textContent = `${prefix}${target.toLocaleString()}${suffix}`;
                    }
                };

                window.requestAnimationFrame(step);
                obs.unobserve(el);
            }
        });
    }, { threshold: 0.5 });

    counterElements.forEach(el => observer.observe(el));
}

/* -------------------------------------------------------------
 * 4. Navbar Dynamic Scroll Blur & Shrink
 * ------------------------------------------------------------- */
function initNavbarScrollEffects() {
    const navbar = document.getElementById('navbar-header');
    if (!navbar) return;

    let lastScroll = 0;
    window.addEventListener('scroll', () => {
        const currentScroll = window.scrollY;
        
        if (currentScroll > 50) {
            navbar.classList.add('top-2', 'py-1');
            navbar.classList.remove('top-6');
        } else {
            navbar.classList.remove('top-2', 'py-1');
            navbar.classList.add('top-6');
        }
        
        lastScroll = currentScroll;
    }, { passive: true });
}

/* -------------------------------------------------------------
 * 5. Divine Ambient Floating Gold Sparks Canvas
 * ------------------------------------------------------------- */
function initDivineParticlesCanvas() {
    const canvas = document.getElementById('divine-particles-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let width = canvas.width = window.innerWidth;
    let height = canvas.height = window.innerHeight;
    let animationFrameId;

    window.addEventListener('resize', () => {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
    });

    const particles = [];
    const particleCount = window.innerWidth < 768 ? 25 : 45;

    for (let i = 0; i < particleCount; i++) {
        particles.push({
            x: Math.random() * width,
            y: Math.random() * height,
            radius: Math.random() * 2.2 + 0.6,
            color: Math.random() > 0.4 ? 'rgba(202, 138, 4, ' : 'rgba(251, 191, 36, ',
            alpha: Math.random() * 0.6 + 0.2,
            speedY: -(Math.random() * 0.45 + 0.15),
            speedX: (Math.random() - 0.5) * 0.3,
            pulseSpeed: Math.random() * 0.02 + 0.005,
            pulseVal: Math.random() * Math.PI
        });
    }

    function render() {
        ctx.clearRect(0, 0, width, height);

        for (let i = 0; i < particles.length; i++) {
            const p = particles[i];
            p.y += p.speedY;
            p.x += p.speedX;
            p.pulseVal += p.pulseSpeed;

            // Reset when going off screen
            if (p.y < -10) {
                p.y = height + 10;
                p.x = Math.random() * width;
            }
            if (p.x < -10) p.x = width + 10;
            if (p.x > width + 10) p.x = -10;

            const currentAlpha = p.alpha * (0.6 + 0.4 * Math.sin(p.pulseVal));

            ctx.beginPath();
            ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctx.fillStyle = `${p.color}${currentAlpha})`;
            ctx.shadowBlur = 10;
            ctx.shadowColor = 'rgba(202, 138, 4, 0.8)';
            ctx.fill();
        }

        animationFrameId = requestAnimationFrame(render);
    }

    // Pause rendering when tab is hidden to save battery/resources
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            cancelAnimationFrame(animationFrameId);
        } else {
            render();
        }
    });

    render();
}

/* -------------------------------------------------------------
 * 6. Global Temple Bell Interactive Audio & Animation
 * ------------------------------------------------------------- */
window.playTempleBell = function() {
    try {
        const ctx = new (window.AudioContext || window.webkitAudioContext)();
        
        // Multi-frequency harmonic resonance for authentic brass temple bell sound
        const frequencies = [587.33, 880.00, 1174.66, 1760.00];
        const gainNodes = [];
        
        frequencies.forEach((freq, index) => {
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            
            osc.type = index === 0 ? 'sine' : 'triangle';
            osc.frequency.setValueAtTime(freq, ctx.currentTime);
            
            // Bell strike attack and slow exponential decay
            const initialVolume = index === 0 ? 0.6 : 0.25 / (index + 1);
            gain.gain.setValueAtTime(initialVolume, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.0001, ctx.currentTime + 3.5);
            
            osc.connect(gain);
            gain.connect(ctx.destination);
            gainNodes.push(gain);
            
            osc.start();
            osc.stop(ctx.currentTime + 3.5);
        });

        // Trigger bell shake visual animation on all bells
        const bellIcons = document.querySelectorAll('.bell-icon, [title*="Bell"] span, button:has(span:contains("🔔")) span');
        document.querySelectorAll('button span, .bell-shake-target').forEach(el => {
            if (el.textContent && el.textContent.includes('🔔')) {
                el.classList.remove('bell-ring-active');
                void el.offsetWidth; // Trigger reflow
                el.classList.add('bell-ring-active');
                setTimeout(() => el.classList.remove('bell-ring-active'), 1100);
            }
        });

        showToast('ॐ हर हर महादेव ॐ', 'Divine Temple Bell sounded. May sacred peace and harmony fill your home.');
    } catch(e) {
        console.log('Audio Context Error:', e);
    }
};

/* -------------------------------------------------------------
 * 7. Global Modal Interactions with Unfold Animations
 * ------------------------------------------------------------- */
function initModalEvents() {
    // ESC key closes modals
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeBookingModal();
            closeDonateModal();
            closeLightbox();
        }
    });
}

window.openBookingModal = function() {
    const modal = document.getElementById('pooja-modal');
    if (!modal) return;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    const scrollEl = modal.querySelector('.parchment-scroll');
    if (scrollEl) {
        scrollEl.classList.remove('modal-unfold');
        void scrollEl.offsetWidth;
        scrollEl.classList.add('modal-unfold');
    }
};

window.closeBookingModal = function() {
    const modal = document.getElementById('pooja-modal');
    if (!modal) return;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
};

window.openDonateModal = function() {
    const modal = document.getElementById('donate-modal');
    if (!modal) return;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    const scrollEl = modal.querySelector('.parchment-scroll');
    if (scrollEl) {
        scrollEl.classList.remove('modal-unfold');
        void scrollEl.offsetWidth;
        scrollEl.classList.add('modal-unfold');
    }
};

window.closeDonateModal = function() {
    const modal = document.getElementById('donate-modal');
    if (!modal) return;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
};

window.setDonateAmt = function(amt) {
    const input = document.getElementById('modal-donate-input');
    if (input) input.value = amt;

    // Highlight selected button
    document.querySelectorAll('#donate-modal .grid button').forEach(btn => {
        if (btn.textContent.includes(amt.toLocaleString())) {
            btn.classList.add('bg-[#912003]', 'text-white', 'scale-105');
            btn.classList.remove('bg-[#FAF6EC]', 'text-[#422B1E]');
        } else {
            btn.classList.remove('bg-[#912003]', 'text-white', 'scale-105');
            btn.classList.add('bg-[#FAF6EC]', 'text-[#422B1E]');
        }
    });
};

/* -------------------------------------------------------------
 * 8. Global Toast Notification
 * ------------------------------------------------------------- */
window.showToast = function(title, msg) {
    const toast = document.getElementById('toast-notify');
    if (!toast) return;
    
    const titleEl = document.getElementById('toast-title');
    const msgEl = document.getElementById('toast-message');
    
    if (titleEl) titleEl.innerText = title;
    if (msgEl) msgEl.innerText = msg;
    
    toast.classList.remove('translate-x-[150%]');
    toast.classList.add('translate-x-0', 'animate-sacred-pulse');
    
    if (window.toastTimeout) clearTimeout(window.toastTimeout);
    window.toastTimeout = setTimeout(() => {
        toast.classList.remove('translate-x-0', 'animate-sacred-pulse');
        toast.classList.add('translate-x-[150%]');
    }, 4500);
};

/* -------------------------------------------------------------
 * 9. Divine Petal / Blessing Celebration Shower
 * ------------------------------------------------------------- */
window.celebrateBlessing = function() {
    const petals = ['🌸', '🌼', '🪷', '✨', '🕉️', '🌿'];
    const container = document.body;
    const count = 30;

    for (let i = 0; i < count; i++) {
        const petal = document.createElement('div');
        petal.innerText = petals[Math.floor(Math.random() * petals.length)];
        petal.style.position = 'fixed';
        petal.style.top = '-20px';
        petal.style.left = `${Math.random() * 100}vw`;
        petal.style.fontSize = `${Math.random() * 20 + 16}px`;
        petal.style.zIndex = '9999';
        petal.style.pointerEvents = 'none';
        petal.style.transition = `all ${Math.random() * 2 + 2.5}s cubic-bezier(0.25, 0.46, 0.45, 0.94)`;
        petal.style.transform = `rotate(${Math.random() * 360}deg)`;
        petal.style.opacity = '1';

        container.appendChild(petal);

        setTimeout(() => {
            petal.style.top = '105vh';
            petal.style.transform = `translateX(${(Math.random() - 0.5) * 200}px) rotate(${Math.random() * 720}deg)`;
            petal.style.opacity = '0';
        }, 50);

        setTimeout(() => {
            petal.remove();
        }, 4500);
    }
};

window.handleModalSubmit = function(e, message) {
    if (e && e.preventDefault) e.preventDefault();
    closeBookingModal();
    closeDonateModal();
    playTempleBell();
    celebrateBlessing();
    showToast('॥ शुभम् भवतु • कल्याणम् ॥', message || 'Sacred request consecrated with divine Vedic blessings.');
};

/* -------------------------------------------------------------
 * 10. Gallery Interactive Filter & Lightbox
 * ------------------------------------------------------------- */
window.filterGallery = function(category) {
    const items = document.querySelectorAll('.gal-item');
    const tabs = document.querySelectorAll('.gal-tab');

    // Update active tab style
    tabs.forEach(tab => {
        if (tab.getAttribute('onclick')?.includes(category)) {
            tab.classList.add('bg-[#912003]', 'text-[#FFFDF9]', 'shadow-md', 'scale-105');
            tab.classList.remove('bg-[#FAF6EC]', 'text-[#422B1E]');
        } else {
            tab.classList.remove('bg-[#912003]', 'text-[#FFFDF9]', 'shadow-md', 'scale-105');
            tab.classList.add('bg-[#FAF6EC]', 'text-[#422B1E]');
        }
    });

    // Animate filtering items with GSAP
    items.forEach(item => {
        const isMatch = category === 'all' || item.classList.contains(category);
        if (isMatch) {
            item.style.display = 'block';
            if (typeof gsap !== 'undefined') {
                gsap.fromTo(item, 
                    { opacity: 0, scale: 0.85, y: 15 },
                    { opacity: 1, scale: 1, y: 0, duration: 0.5, ease: "power2.out" }
                );
            } else {
                item.style.opacity = '1';
                item.style.transform = 'scale(1)';
            }
        } else {
            if (typeof gsap !== 'undefined') {
                gsap.to(item, {
                    opacity: 0,
                    scale: 0.85,
                    duration: 0.3,
                    onComplete: () => { item.style.display = 'none'; }
                });
            } else {
                item.style.display = 'none';
            }
        }
    });
};

window.openLightbox = function(src, caption) {
    let lb = document.getElementById('gallery-lightbox');
    if (!lb) {
        lb = document.createElement('div');
        lb.id = 'gallery-lightbox';
        lb.className = 'fixed inset-0 z-50 bg-black/85 backdrop-blur-md hidden flex flex-col items-center justify-center p-4 transition-all duration-300';
        lb.innerHTML = `
            <button onclick="closeLightbox()" class="absolute top-6 right-6 text-[#FFFDF9] hover:text-[#CA8A04] w-12 h-12 rounded-full bg-black/50 border border-[#A16207]/40 flex items-center justify-center text-2xl transition-all cursor-pointer">✕</button>
            <div class="max-w-4xl w-full parchment-scroll p-4 rounded-3xl antique-border shadow-2xl overflow-hidden text-center">
                <img id="lb-image" src="" alt="Darshan" class="w-full max-h-[75vh] object-contain rounded-2xl mx-auto">
                <p id="lb-caption" class="font-cinzel text-base text-[#1C120C] font-bold mt-4 px-4"></p>
            </div>
        `;
        document.body.appendChild(lb);
    }

    const img = document.getElementById('lb-image');
    const cap = document.getElementById('lb-caption');
    img.src = src;
    cap.innerText = caption;
    lb.classList.remove('hidden');
    lb.classList.add('flex');

    if (typeof gsap !== 'undefined') {
        gsap.fromTo(lb.querySelector('.parchment-scroll'),
            { opacity: 0, scale: 0.9, y: 20 },
            { opacity: 1, scale: 1, y: 0, duration: 0.4, ease: "power3.out" }
        );
    }
};

window.closeLightbox = function() {
    const lb = document.getElementById('gallery-lightbox');
    if (lb) {
        lb.classList.add('hidden');
        lb.classList.remove('flex');
    }
};
