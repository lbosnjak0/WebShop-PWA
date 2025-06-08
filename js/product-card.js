 // Proširi i sažmi kartice proizvoda klikom. Samo jedna kartica može
// prikazati puni opis istovremeno, a klikom izvan nje zatvara se.
window.addEventListener('DOMContentLoaded', () => {
  const cards = document.querySelectorAll('.product-card');
  let activeCard = null;

  function showFull(card) {
    const shortText = card.querySelector('.short-text');
    const fullText = card.querySelector('.full-text');
    if (shortText && fullText) {
      shortText.classList.add('d-none');
      fullText.classList.remove('d-none');
      activeCard = card;
    }
  }

  function hideFull(card) {
    const shortText = card.querySelector('.short-text');
    const fullText = card.querySelector('.full-text');
    if (shortText && fullText) {
      shortText.classList.remove('d-none');
      fullText.classList.add('d-none');
    }
  }

  cards.forEach(card => {
    card.addEventListener('click', e => {
      e.stopPropagation();
      if (activeCard && activeCard !== card) {
        hideFull(activeCard);
      }
      showFull(card);
    });
  });

  document.addEventListener('click', () => {
    if (activeCard) {
      hideFull(activeCard);
      activeCard = null;
    }
  });
});
