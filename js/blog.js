/**
 * Blog JavaScript - Light Yield Co., Ltd.
 * Image Modal / Lightbox implementation for article figures.
 */
(() => {
  const initImageModal = () => {
    // 既存モーダルの多重生成防止
    let modal = document.querySelector('.image_modal');
    if (!modal) {
      modal = document.createElement('div');
      modal.className = 'image_modal';
      modal.setAttribute('role', 'dialog');
      modal.setAttribute('aria-modal', 'true');
      modal.setAttribute('aria-hidden', 'true');

      modal.innerHTML = `
        <button type="button" class="image_modal_close" aria-label="閉じる">&times;</button>
        <div class="image_modal_inner">
          <img src="" alt="" class="image_modal_img">
          <p class="image_modal_caption"></p>
        </div>
      `;
      document.body.appendChild(modal);

      const modalImg = modal.querySelector('.image_modal_img');
      const modalCaption = modal.querySelector('.image_modal_caption');
      const closeBtn = modal.querySelector('.image_modal_close');

      const openModal = (src, alt, captionText) => {
        modalImg.src = src;
        modalImg.alt = alt || '';
        modalCaption.textContent = captionText || '';
        modalCaption.style.display = captionText ? 'block' : 'none';
        modal.classList.add('is_active');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
      };

      const closeModal = () => {
        modal.classList.remove('is_active');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
      };

      // 閉じる操作
      closeBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        closeModal();
      });

      modal.addEventListener('click', (e) => {
        e.stopPropagation();
        closeModal();
      });

      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('is_active')) {
          closeModal();
        }
      });

      // イベントデリゲーションで確実にクリックを補足
      document.addEventListener('click', (e) => {
        const img = e.target.closest('.article_figure img');
        if (img) {
          e.preventDefault();
          e.stopPropagation();
          const figure = img.closest('.article_figure');
          const figcaption = figure ? figure.querySelector('figcaption') : null;
          const captionText = figcaption ? figcaption.textContent.trim() : (img.alt || '');
          openModal(img.src, img.alt, captionText);
        }
      });
    }
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initImageModal);
  } else {
    initImageModal();
  }
})();
