import 'url-search-params-polyfill';

if (document.querySelector('.finder')) {
  (async () => {
    // default status
    const status = {
      'level': [],
      'department': '',
      'format': [],
      'campus': '',
      'search': '',
    };

    // search input timeout
    let searchTimeout;

    // elements
    const filterTab = document.querySelector('.finder__tab--filter');
    const filterContent = document.querySelector('.finder__filter');
    const filterInputs = document.querySelectorAll('[data-filter]')
    const searchTab = document.querySelector('.finder__tab--search');
    const searchContent = document.querySelector('.finder__search');
    const searchInput = document.querySelector('#finder__input');
    const searchSuggestions = document.querySelectorAll('.finder__suggestion');
    const info = document.querySelector('.finder__info');
    const results = document.querySelector('.finder__results');

    // create event
    const createEvent = (type) => {
      let event;
      if (typeof(Event) === 'function') {
        event = new Event(type);
      } else {
        event = document.createEvent('Event');
        event.initEvent(type, true, true);
      }
      return event;
    };

    // get data
    const getData = async () => {
      const response = await fetch('/program-finder/program-finder-json');
      const json = await response.json();
      return json.programs.sort(function(a, b) {
        var nameA = a.title.toUpperCase(); // ignore upper and lowercase
        var nameB = b.title.toUpperCase(); // ignore upper and lowercase
        if (nameA < nameB) {
          return -1;
        }
        if (nameA > nameB) {
          return 1;
        }

        // names must be equal
        return 0;
      });
      //return json.programs.sort().reverse();
    };

    // handle filter tab
    const handleFilterTab = () => {
      filterTab.classList.add('finder__tab--active');
      filterContent.classList.add('finder__filter--active');
      searchTab.classList.remove('finder__tab--active');
      searchContent.classList.remove('finder__search--active');
    };

    // handle search tab
    const handleSearchTab = () => {
      searchTab.classList.add('finder__tab--active');
      searchContent.classList.add('finder__search--active');
      filterTab.classList.remove('finder__tab--active');
      filterContent.classList.remove('finder__filter--active');
    };

    // item template
    const itemTemplate = (program) => {
      return `
        <div class="finder__item">
          <div class="finder__title">${program.title}</div>
          <div class="finder__tags">
            ${program.level.map((item, i) => `
              <a href="${item.url}" class="finder__tag">${item.name}</a>
            `).join('')}
          </div>
        </div>
      `;
    };

    // update status
    const updateStatus = () => {
      status.level = [];
      status.format = [];
      Array.from(filterInputs).forEach((input) => {
        if (input.checked) {
          const type = input.getAttribute('data-filter');
          const value = input.value;
          if (type === 'level' || type === 'format') {
            status[type].push(value);
          } else {
            status[type] = value;
          }
        }
      });
    };

    // update info
    const updateInfo = () => {
      let html = '';
      const count = document.querySelectorAll('.finder__item').length;
      if (programs.length !== count) {
        html += `<span class="finder__count">${count} Result${count !== 1 ? 's' : ''}</span>`;
      }
      Array.from(filterInputs).forEach((input) => {
        if (input.checked && input.value) {
          const type = input.getAttribute('data-filter');
          const value = input.value;
          const label = input.nextElementSibling.innerText;
          html += `<button class="finder__remove" data-type="${type}" data-value="${value}">${label}</button>`;
        }
      });
      if (status.search) {
        html += `<button class="finder__remove" data-type="search">Search: ${status.search}</button>`;
      }
      if (programs.length !== count) {
        html += `<button class="finder__reset">Reset</button>`;
      }
      info.innerHTML = html;
    };

    // update items
    const updateItems = (programs) => {
      let html = '';
      programs.forEach((program) => {
        html += itemTemplate(program);
      });
      results.innerHTML = html;
    };

    // matches level
    const matchesLevel = (program) => {
      let matches = true;
      let innermatch = false;
      status.level.forEach((level) => {
        program.level.forEach((item) => {
          if (item.name.startsWith(level, 0)) {
            innermatch = true;
          };
        });
        matches = innermatch;
      });
      return matches;
    };

    // matches department
    const matchesDepartment = (program) => {
      if (status.department === '' || program.department.includes(status.department)) return true;
    };

    // matches format
    const matchesFormat = (program) => {
      let matches = true;
      status.format.forEach((format) => {
        if (!program.format.includes(format)) {
          matches = false;
        };
      });
      return matches;
    };

    // matches campus
    const matchesCampus = (program) => {
      if (status.campus === '' || program.campus.includes(status.campus)) return true;
    };

    // matches search
    const matchesSearch = (program) => {
      if (status.search === '' || program.title.toLowerCase().includes(status.search.toLowerCase())) return true;
    };

    // filter programs
    const filterPrograms = () => {
      let filtered;
      updateStatus();
      filtered = programs.filter((program) => {
        if (matchesLevel(program) && matchesDepartment(program) && matchesFormat(program) && matchesCampus(program) && matchesSearch(program)) return true;
      });
      updateItems(filtered);
      updateInfo();
    };

    // setup programs data
    const programs = await getData();

    // add initial items
    filterPrograms();

    // handle filter tab click
    filterTab.addEventListener('click', handleFilterTab);

    // handle search tab click
    searchTab.addEventListener('click', handleSearchTab);

    // handle filter input change
    Array.from(filterInputs).forEach((input) => {
      input.addEventListener('change', filterPrograms);
    });

    // handle search input change
    searchInput.addEventListener('input', () => {
      clearTimeout(searchTimeout);
      searchTimeout = setTimeout(() => {
        status.search = searchInput.value;
        filterPrograms();
      }, 300);
    });

    // handle search suggestions
    Array.from(searchSuggestions).forEach((suggestion) => {
      suggestion.addEventListener('click', () => {
        const value = suggestion.innerText;
        searchInput.value = value;
        searchInput.dispatchEvent(createEvent('input'));
      });
    });

    // handle info button click
    info.addEventListener('click', (e) => {
      const target = e.target;
      if (target.classList.contains('finder__remove')) {
        const type = target.getAttribute('data-type');
        const value = (type === 'department' || type === 'campus') ? '' : target.getAttribute('data-value');
        const input = document.querySelector(`[data-filter="${type}"][value="${value}"]`);
        if (type === 'search') {
          searchInput.value = '';
          searchInput.dispatchEvent(createEvent('input'));
        } else {
          input.click();
        }
      }
      if (target.classList.contains('finder__reset')) {
        while (document.querySelectorAll('.finder__remove').length) {
          document.querySelector('.finder__remove').click();
        }
      }
    });

    // handle url query params
    const search = new URLSearchParams(window.location.search);
    search.forEach((value, key) => {
      const values = value.split(';');
      values.forEach((val) => {
        const el = document.querySelector(`[data-filter="${key}"][value="${val}"]`);
        if (el) {
          el.click();
        }
      });
    });
  })();
}
