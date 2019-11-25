<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">

        <style>
            body {
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                background-color: #ECEFF1;
                font-family: 'Roboto', sans-serif;
            }

            .bin:hover .space {
                box-shadow: inset 0px 0px 1px rgba(0, 0, 0, 1);
            }
        </style>
    </head>

    <body>
        <div style="width: 100%;">
            @foreach($bins as $bin)
            <h2 style="margin-top: 2rem;">Order Sheet {{ $loop->iteration }} <span style="font-size: .8rem;">({{ ($bin['bin'])->width() }}x{{ ($bin['bin'])->height() }})</span></h2>
            <div style="display: flex; width: 100%">
                <div class="bin" style="position: relative; background-color: #fff; border: 1px solid #000; width: {{ $bin['bin']->width() }}rem; height: {{ $bin['bin']->height() }}rem; overflow: hidden;">
                    @foreach($bin['items'] as $item)
                    @if($item->node() && $item->node()->isTaken())
                    <div title="{{ $item->product()->title }} (x:{{ $item->node()->x() }} y:{{ $item->node()->y() }} w:{{ $item->node()->width() }} h:{{ $item->node()->height() }})" style="position: absolute; line-height: 0; background-color: #{{ $item->product()->color }}; color: rgba(255,255,255,.7); font-weight: 700; box-shadow: inset 0px 0px 1px rgba(0,0,0,1); top: {{ $item->node()->y() }}rem; left: {{ $item->node()->x() }}rem; width: {{ $item->node()->width() }}rem; height: {{ $item->node()->height() }}rem; font-size: .5rem; display: flex; justify-content: center; align-items: center;">
                        <span style="transform: rotate({{ $item->isRotated() ? '90' : '0' }}deg);">{{ $item->product()->id }}</span>
                    </div>
                    @endif
                    @endforeach

                    @foreach(($bin['bin'])->getFreeSpace() as $node)
                    <div class="space" title="Free Space (x:{{ $node[0] }} y:{{ $node[1] }} w:{{ $node[2] }} h:{{ $node[3] }})" style="position: absolute; line-height: 0; background-color: #ccc; top: {{ $node[1] }}rem; left: {{ $node[0] }}rem; width: {{ $node[2] }}rem; height: {{ $node[3] }}rem;"></div>
                    @endforeach
                </div>
                <div style="margin: 0 1rem;">
                    <p style="margin-bottom: .5rem; margin-top: 0;">Products:</p>
                    @foreach($bin['products'] as $product)
                    <div style="display: flex; align-items: center; margin-bottom: .5rem; line-height: 0;">
                        <span style="display: flex; justify-content: center; align-items: center; width: 1rem; height: 1rem; font-size: .6rem; color: rgba(255,255,255,.7); font-weight: 700; background-color: #{{ $product->color }}; box-shadow: inset 0px 0px 1px rgba(0,0,0,1);">{{ $product->id }}</span><span style="margin-left: .5rem; font-size: .8rem;">{{ $product->title }} ({{ $product->size }})</span>
                    </div>
                    @endforeach
                    <div style="display: flex; align-items: center; margin-bottom: .5rem; line-height: 0;">
                        <span style="display: flex; justify-content: center; align-items: center; width: 1rem; height: 1rem; font-size: .6rem; background-color: #ccc; color: #ccc">0</span><span style="margin-left: .5rem; font-size: .8rem;">Free Space</span>
                    </div>
                    <p style="font-size: .8rem;">{{ ($bin['items'])->count()  }} {{ Str::plural('product', ($bin['items'])->count()) }} total</p>
                </div>
            </div>
            @if(($bin['overflow'])->isNotEmpty())
            <h4 style="margin: .5rem 0;">Sheet {{ $loop->iteration }}: Overflow</h4>
            <div style="position: relative; width: 100%; display: flex; flex-wrap: wrap;">
                @foreach($bin['overflow'] as $item)
                <div title="{{ $item->product()->title }} (w:{{ $item->product()->width() }} h:{{ $item->product()->height() }})" style="background-color: #{{ $item->product()->color }}; line-height: 0; color: rgba(255,255,255,.7); font-weight: 700; flex-shrink: 0; flex-grow: 0; box-shadow: inset 0px 0px 1px rgba(0,0,0,1); width: {{ $item->product()->width() }}rem; height: {{ $item->product()->height() }}rem; font-size: .5rem; display: flex; justify-content: center; align-items: center;">{{ $item->product()->id }}</div>
                @endforeach
            </div>
            @endif
            @endforeach
        </div>
    </body>

</html>
