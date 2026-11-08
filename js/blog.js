/**
 * Blog JavaScript - Light Yield Co., Ltd.
 * 1. Image Modal / Lightbox implementation for article figures.
 * 2. Category Tabs Controller with URL Hash & WAI-ARIA support (DADS / WCAG 2.1 AA).
 */
(() => {
  // --- 1. Image Modal for Article Figures ---
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

  // --- 2. Category Tabs Controller (DADS / WAI-ARIA Compliant) ---
  const initCategoryTabs = () => {
    const tabNav = document.querySelector('.blog_category_nav');
    const tabList = document.querySelector('.category_tabs');
    if (!tabNav || !tabList) return;

    const tabs = Array.from(tabList.querySelectorAll('[role="tab"]'));
    const blocks = Array.from(document.querySelectorAll('.category_block'));
    if (tabs.length === 0 || blocks.length === 0) return;

    // 自動カウント集計・同期（記事数が追加された際も自動反映）
    let totalCount = 0;
    blocks.forEach((block) => {
      const count = block.querySelectorAll('.blog_card').length;
      totalCount += count;
      const targetTab = tabs.find((t) => t.dataset.target === block.id);
      if (targetTab) {
        const countBadge = targetTab.querySelector('.category_tab_count');
        if (countBadge) countBadge.textContent = count;
      }
    });
    const allTab = tabs.find((t) => t.dataset.target === 'all');
    if (allTab) {
      const countBadge = allTab.querySelector('.category_tab_count');
      if (countBadge) countBadge.textContent = totalCount;
    }

    // タブ切り替え処理
    const switchTab = (targetId, shouldUpdateHistory = true, shouldScroll = false) => {
      let activeTab = tabs.find((t) => t.dataset.target === targetId);
      if (!activeTab) {
        activeTab = allTab || tabs[0];
        targetId = activeTab.dataset.target;
      }

      // タブのアクセシビリティ属性およびクラス更新
      tabs.forEach((tab) => {
        const isSelected = tab === activeTab;
        tab.classList.toggle('is_active', isSelected);
        tab.setAttribute('aria-selected', isSelected ? 'true' : 'false');
        tab.setAttribute('tabindex', isSelected ? '0' : '-1');
      });

      // コンテンツブロックの表示・非表示制御
      blocks.forEach((block) => {
        if (targetId === 'all' || block.id === targetId) {
          block.removeAttribute('hidden');
        } else {
          block.setAttribute('hidden', '');
        }
      });

      // URLハッシュの更新（ブラウザ履歴を無駄に増やさない replaceState）
      if (shouldUpdateHistory) {
        const newUrl = targetId === 'all'
          ? window.location.pathname + window.location.search
          : '#' + targetId;
        if (window.location.hash !== (targetId === 'all' ? '' : '#' + targetId)) {
          history.replaceState(null, '', newUrl);
        }
      }

      // スクロール位置の配慮（タブが画面外にスクロールして隠れている場合、タブ位置へスムーズスクロール）
      if (shouldScroll) {
        const navRect = tabNav.getBoundingClientRect();
        if (navRect.top < 0) {
          tabNav.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }

      // モバイル等でタブが横スクロール領域からはみ出している場合、アクティブタブを視界内にスクロール
      if (tabNav.scrollWidth > tabNav.clientWidth) {
        activeTab.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'nearest' });
      }
    };

    // クリックイベント
    tabs.forEach((tab) => {
      tab.addEventListener('click', (e) => {
        e.preventDefault();
        const target = tab.dataset.target;
        switchTab(target, true, true);
        tab.focus();
      });
    });

    // キーボード操作（WAI-ARIA APG Tabs Pattern）
    tabList.addEventListener('keydown', (e) => {
      const currentIndex = tabs.indexOf(document.activeElement);
      if (currentIndex === -1) return;

      let nextIndex = null;
      if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
        e.preventDefault();
        nextIndex = (currentIndex + 1) % tabs.length;
      } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
        e.preventDefault();
        nextIndex = (currentIndex - 1 + tabs.length) % tabs.length;
      } else if (e.key === 'Home') {
        e.preventDefault();
        nextIndex = 0;
      } else if (e.key === 'End') {
        e.preventDefault();
        nextIndex = tabs.length - 1;
      }

      if (nextIndex !== null) {
        const nextTab = tabs[nextIndex];
        nextTab.focus();
        switchTab(nextTab.dataset.target, true, false);
      }
    });

    // 初期状態の判定（URLハッシュの確認）
    const initialHash = window.location.hash.replace(/^#/, '');
    if (initialHash && tabs.some((t) => t.dataset.target === initialHash)) {
      switchTab(initialHash, false, false);
      // ブラウザ標準のアンカージャンプでヘッダーやタブが見切れるのを防ぎ、自然なトップ表示にする
      window.scrollTo(0, 0);
    } else {
      switchTab('all', false, false);
    }

    // ブラウザの戻る/進む（hashchange）対応
    window.addEventListener('hashchange', () => {
      const hash = window.location.hash.replace(/^#/, '');
      if (hash && tabs.some((t) => t.dataset.target === hash)) {
        switchTab(hash, false, true);
      } else {
        switchTab('all', false, true);
      }
    });
  };

  const init = () => {
    initImageModal();
    initCategoryTabs();
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
