@extends('_layout.base')
@section('body')
        <header style="background-image: url('/images/uploads/{{ $article->id }}/header.jpg')">
            <h1>{{ $article->title}}</h1>
            <time title="{{ $article->created_at }}" itemprop="datePublished" datetime="{{ $article->created_at }}">{{ $article->created_at->diffForHumans() }}</time>
        </header>
        <section>
            <div class="article">
                <time class="dateModified" itemprop="dateModified" datetime="{{ $article->updated_at }}">{{ $article->updated_at }}</time>
                <script>hljs.initHighlightingOnLoad();</script>
                {!! (new Parsedown())->text($article->text) !!}
            </div>
            <div class="comments">
                <div id="disqus_thread"></div>
                <script type="text/javascript">
                    /* * * CONFIGURATION VARIABLES * * */
                    var disqus_shortname = 'jamieshepherd';

                    /* * * DON'T EDIT BELOW THIS LINE * * */
                    (function() {
                        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
            </div>
        </section>
@stop
