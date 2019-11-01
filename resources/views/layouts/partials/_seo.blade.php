<title>{{ $seo['title'] ?? 'Wine Boutique' }}</title>
<meta name="description" content="{{ $seo['description'] ?? 'Wine Boutique' }}">
<link rel="canonical" href="{{ url('') }}" />

<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:title" content="{{ $seo['title'] ?? 'Wine Boutique' }}" />
<meta property="og:description" content="{{ $seo['description'] ?? 'Wine Boutique' }}" />
<meta property="og:image" content="{{ $seo['image'] ?? '' }}" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="Wine Boutique" />

<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="{{ $seo['title'] ?? 'Wine Boutique' }}" />
<meta name="twitter:description" content="{{ $seo['description'] ?? 'Wine Boutique' }}" />
<meta name="twitter:image" content="{{ $seo['image'] ?? '' }}" />
