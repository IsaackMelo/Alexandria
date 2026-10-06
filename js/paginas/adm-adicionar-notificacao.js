        (function(){
          function initBox(box){
            if(box.dataset.rteInit === '1') return;
            box.dataset.rteInit = '1';

            const content = box.querySelector('.rte-content');
            content.setAttribute('data-placeholder', box.getAttribute('data-placeholder') || '');

            const morePanel = box.querySelector('.rte-more-panel');
            const moreToggle = box.querySelector('[data-action="more"]');
            const wordcountEl = box.querySelector('.rte-wordcount');

            let savedRange = null;
            let history = [content.innerHTML];
            let historyIndex = 0;
            let typingTimer = null;

            function saveSelection(){
              const sel = window.getSelection();
              if(sel.rangeCount > 0 && content.contains(sel.anchorNode)) savedRange = sel.getRangeAt(0);
            }
            function restoreSelection(){
              const sel = window.getSelection();
              sel.removeAllRanges();
              if(savedRange) sel.addRange(savedRange);
            }
            function pushHistory(){
              if(content.innerHTML === history[historyIndex]) return;
              history = history.slice(0, historyIndex + 1);
              history.push(content.innerHTML);
              historyIndex = history.length - 1;
            }
            function undo(){
              if(historyIndex > 0){ historyIndex--; content.innerHTML = history[historyIndex]; updateWordcount(); }
            }
            function redo(){
              if(historyIndex < history.length - 1){ historyIndex++; content.innerHTML = history[historyIndex]; updateWordcount(); }
            }
            function updateWordcount(){
              const text = content.innerText.trim();
              const words = text.length ? text.split(/\s+/).length : 0;
              wordcountEl.textContent = words + (words === 1 ? ' palavra' : ' palavras');
            }
            function updateActiveStates(){
              box.querySelectorAll('[data-cmd]').forEach(btn=>{
                try{ btn.classList.toggle('active', document.queryCommandState(btn.dataset.cmd)); }catch(e){}
              });
            }
            function exec(cmd, value=null){
              content.focus();
              restoreSelection();
              document.execCommand(cmd, false, value);
              pushHistory();
              updateActiveStates();
              updateWordcount();
            }

            content.addEventListener('focus', ()=> box.classList.add('focused'));
            content.addEventListener('blur', ()=> box.classList.remove('focused'));
            content.addEventListener('mouseup', saveSelection);
            content.addEventListener('keyup', ()=>{ saveSelection(); updateActiveStates(); });
            content.addEventListener('input', ()=>{
              updateWordcount();
              clearTimeout(typingTimer);
              typingTimer = setTimeout(pushHistory, 500);
            });

            box.querySelectorAll('[data-cmd]').forEach(btn=>{
              btn.addEventListener('click', ()=> exec(btn.dataset.cmd));
            });

            box.querySelector('[data-action="clear"]').addEventListener('click', ()=>{
              content.focus();
              restoreSelection();
              document.execCommand('removeFormat');
              pushHistory();
            });

            box.querySelector('[data-action="undo"]').addEventListener('click', undo);
            box.querySelector('[data-action="redo"]').addEventListener('click', redo);

            box.querySelector('[data-action="link"]').addEventListener('click', ()=>{
              saveSelection();
              const url = prompt('Cole o link:');
              if(!url) return;
              const safeUrl = /^https?:\/\//i.test(url) ? url : 'https://' + url;
              exec('createLink', safeUrl);
            });

            box.querySelector('[data-action="image"]').addEventListener('click', ()=>{
              const input = document.createElement('input');
              input.type = 'file';
              input.accept = 'image/*';
              input.onchange = e=>{
                const file = e.target.files[0];
                if(!file) return;
                const reader = new FileReader();
                reader.onload = ev=> exec('insertImage', ev.target.result);
                reader.readAsDataURL(file);
              };
              input.click();
            });

            box.querySelector('.rte-font-family').addEventListener('change', function(){ exec('fontName', this.value); });
            box.querySelector('.rte-font-size').addEventListener('change', function(){ exec('fontSize', this.value); });
            box.querySelector('.rte-text-color').addEventListener('input', function(){ exec('foreColor', this.value); });
            box.querySelector('.rte-highlight-color').addEventListener('input', function(){ exec('hiliteColor', this.value); });

            moreToggle.addEventListener('click', (e)=>{
              e.stopPropagation();
              morePanel.classList.toggle('show');
            });
            document.addEventListener('click', (e)=>{
              if(!box.contains(e.target)) morePanel.classList.remove('show');
            });
          }

          document.querySelectorAll('.rte-box:not([data-rte-init])').forEach(initBox);
        })();
        
