document.addEventListener('DOMContentLoaded', function () {
  const interBubble = document.querySelector('.interactive');

  if (interBubble) {
    let curX = 0, curY = 0, tgX = 0, tgY = 0;

    function move() {
      curX += (tgX - curX) / 20;
      curY += (tgY - curY) / 20;
      interBubble.style.transform = `translate(${Math.round(curX)}px, ${Math.round(curY)}px)`;
      requestAnimationFrame(move);
    }

    function handleMoveEvent(event) {
      if (event instanceof MouseEvent) {
        tgX = event.clientX;
        tgY = event.clientY;
      } else if (event.touches && event.touches.length > 0) {
        tgX = event.touches[0].clientX;
        tgY = event.touches[0].clientY;
      }
    }

    window.addEventListener('mousemove', handleMoveEvent);
    window.addEventListener('touchmove', handleMoveEvent);
    move();
  } else {
    console.error("Elemento '.interactive' non trovato.");
  }
});
