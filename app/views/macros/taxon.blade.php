<section class="taxon {{{ $taxon->rank }}} hidden"
    data-name="{{{ snake_case($taxon->name) }}}"
    data-id="{{{ $taxon->id }}}"
    data-parent="{{{ $taxon->parent_id or '0' }}}"
    data-depth="{{{ $taxon->depth }}}"
    data-top="0"
    data-left="0"
    >
    <article>
        <h1>{{{ $taxon->name }}}</h1>

        <p>{{{ ucwords($taxon->rank) }}}</p>

        <aside>
            <p>{{{ ($taxon->extant) ? 'Extant' : 'Extinct' }}}</p>
        </aside>
    </article>
</section>

@foreach ($taxon->children as $child)
    {{ HTML::taxon($child) }}
@endforeach