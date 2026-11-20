@extends('layouts.public')
@section('title', 'Our story — Faza Coffee')
@section('content')
<section class="page-intro page-intro-story">
    <p class="eyebrow"><span class="eyebrow-line"></span> A business by PT Fathuddin Zaki</p>
    <h1>Every cup holds<br><em>a little story.</em></h1>
    <p>Faza Coffee is a place for carefully made drinks, familiar comfort, and the conversations that stay with us.</p>
</section>
<section class="about-feature">
    <div class="about-logo-panel"><img src="{{ asset('images/faza_coffee.png') }}" alt="Faza Coffee logo"><span>FRESHLY BREWED MOMENTS</span></div>
    <div class="about-copy">
        <p class="eyebrow">Our way of doing things</p>
        <h2>Quality in the cup.<br><em>Warmth in every visit.</em></h2>
        <p>Faza Coffee, a brand by PT Fathuddin Zaki, brings thoughtful coffee and refreshing non-coffee favorites together in one welcoming neighborhood spot. We care about balanced flavors, good ingredients, and the small details that make a coffee break feel like yours.</p>
        <p>Whether you are catching up with a friend, finding a quiet moment, or simply picking up your usual, there is always room for another story here.</p>
        <a class="text-link" href="{{ route('catalog') }}">Discover our menu <span aria-hidden="true">→</span></a>
    </div>
</section>
<section class="section values-section">
    <div class="section-heading"><div><p class="eyebrow">What matters to us</p><h2>Simple things, done thoughtfully.</h2></div></div>
    <div class="info-grid">
        <article class="info-card"><span>01</span><h3>Careful craft</h3><p>Balanced recipes, quality ingredients, and attention in every cup.</p></article>
        <article class="info-card"><span>02</span><h3>Everyday comfort</h3><p>Familiar flavors and a warm welcome, whether it is your first visit or your fiftieth.</p></article>
        <article class="info-card"><span>03</span><h3>Room for stories</h3><p>A comfortable place to meet, work, study, or take a breath between things.</p></article>
    </div>
</section>
@endsection
