<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">

  <label>
    <span class="screen-reader-text">Search AESU:</span>

    <input
      type="search"
      class="search-field"
      placeholder="Search AESU"
      value="<?php echo get_search_query(); ?>"
      name="s"
    />
  </label>

  <button type="submit" class="search-submit" aria-label="Submit search">
    <i class="fa-solid fa-magnifying-glass"></i>
    <span class="screen-reader-text">Search</span>
  </button>

</form>