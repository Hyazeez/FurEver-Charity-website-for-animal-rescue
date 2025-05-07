document.addEventListener("DOMContentLoaded", () => {
  const counters = [
    { id: "rescued", target: 1200 },
    { id: "rehomed", target: 900 },
    { id: "volunteers", target: 300 }
  ];

  let started = false;

  function animateCounter(id, target) {
    const speed = 100;
    const increment = Math.ceil(target / speed);
    const element = document.getElementById(id);
    let count = 0;

    const update = () => {
      count += increment;
      if (count < target) {
        element.textContent = count;
        requestAnimationFrame(update);
      } else {
        element.textContent = target;
      }
    };

    update();
  }

  function handleScroll() {
    const statsSection = document.querySelector('.item3');
    const rect = statsSection.getBoundingClientRect();

    if (!started && rect.top < window.innerHeight) {
      counters.forEach(counter => animateCounter(counter.id, counter.target));
      started = true;
    }
  }

  window.addEventListener("scroll", handleScroll);
});

