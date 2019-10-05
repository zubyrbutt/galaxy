<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{ ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard' }}
  </h1>
  {{ Breadcrumbs::render() }}
</section>