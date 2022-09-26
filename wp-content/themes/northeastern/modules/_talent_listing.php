<div class="talent-listing">

  <label for="talent-search" class="hide">Search</label>
  <input id="talent-search" class="list__input" type="search" placeholder="Search">

  <hr class="hr--small">

  <div class="dropdown__filters">

    <span class="dropdown__label label">Filter by:</span>

    <label class="filter__label filter__label--alt">
      <input type="checkbox" value="phd">
      <span class="filter__checkbox">PhD Student</span>
    </label>

    <label class="filter__label filter__label--alt">
      <input type="checkbox" value="postdoc">
      <span class="filter__checkbox">Postdoc</span>
    </label>

    <label for="discipline" class="hide">Select discipline</label>
    <select class="dropdown__select" id="discipline">
      <option>Discipline</option>
      <option>Praesentium, doloremque.</option>
      <option>Temporibus, recusandae.</option>
      <option>Quia, excepturi.</option>
      <option>In, cumque.</option>
      <option>Aspernatur, voluptatibus!</option>
    </select>

    <div class="dropdown__filters__group">
      <button class="cta cta--red">
        Apply Filters
      </button>
      <br>
      <a href="#" class="cta__link">
        <span>Reset Filters</span>
      </a>
    </div>

  </div>

  <div class="list__search__group">
    <span class="list__search__label label">Or Search by Letter:</span>
    <a href="#" class="list__search__link active">A</a>
    <a href="#" class="list__search__link">B</a>
    <a href="#" class="list__search__link">C</a>
    <a href="#" class="list__search__link">D</a>
    <a href="#" class="list__search__link">E</a>
    <a href="#" class="list__search__link">F</a>
    <a href="#" class="list__search__link">G</a>
    <a href="#" class="list__search__link">H</a>
    <a href="#" class="list__search__link">I</a>
    <a href="#" class="list__search__link">J</a>
    <a href="#" class="list__search__link">K</a>
    <a href="#" class="list__search__link">L</a>
    <a href="#" class="list__search__link">M</a>
    <a href="#" class="list__search__link">N</a>
    <a href="#" class="list__search__link">O</a>
    <a href="#" class="list__search__link">P</a>
    <a href="#" class="list__search__link">Q</a>
    <a href="#" class="list__search__link">R</a>
    <a href="#" class="list__search__link">S</a>
    <a href="#" class="list__search__link">T</a>
    <a href="#" class="list__search__link">U</a>
    <a href="#" class="list__search__link">V</a>
    <a href="#" class="list__search__link">W</a>
    <a href="#" class="list__search__link">X</a>
    <a href="#" class="list__search__link">Y</a>
    <a href="#" class="list__search__link">Z</a>
  </div>

  <div class="grid grid--2">
    <div class="list__result">
      <span>
        157 Items found
      </span>
    </div>
    <div id="pagination" class="pagination">
      [pagination]
    </div>
  </div>

  <div class="list">
    <div class="grid grid--4">

      <?php $i = 0; while ($i < 8) : ?>
        <div>
          <div class="block-small">
            <img src="//placehold.mstoner.com/173x230" alt="placeholder" class="block-smaller-bottom">
            <h2 class="list__contact__headline">
              <span class="contact__name contact__name--alt">Jerome F. Hajjar</span>
            </h2>
            <p class="text-small">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis consectetur saepe praesentium eos eius quas, perspiciatis harum explicabo.</p>
            <ul class="caption caption__link__list--alt">
              <li>
                <a href="#" class="caption__link">jf.hajjar@northeastern.edu</a>
              </li>
              <li>
                <a href="#" class="contact__icon">
                  <span class="hide">LinkedIn</span>
                  <?php echo svgstore('linkedin', '', ''); ?>
                </a>
                <a href="#" class="contact__icon">
                  <span class="hide">Personal Link</span>
                  <?php echo svgstore('arrow-up-right', '', ''); ?>
                </a>
              </li>
            </ul>
          </div>
        </div>
      <?php $i += 1; endwhile; ?>

    </div>
  </div>

  <div id="pagination" class="pagination block">
    [pagination]
  </div>

  <hr>

  <div class="main__narrow">
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta, veritatis dolorum. Nostrum quasi iste, assumenda libero molestias velit.</p>
    <p><a href="#"><strong>Lorem, ipsum dolor.</strong></a> &nbsp; &nbsp; <a href="#"><strong>Lorem, ipsum dolor.</strong></a></p>
  </div>

</div>
