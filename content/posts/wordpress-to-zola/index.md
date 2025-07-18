+++
aliases = ['/logs/wordpress-to-zola']
date = '2022-07-29'
location = 'SAN FRANCISCO, CALIFORNIA'
title = 'Wordpress to Zola'
+++

## Some background

I recently migrated my personal website from [WordPress](https://wordpress.org) to [Zola](https://getzola.org), a Rust-powered static site generator. I've used static site generators in past versions of this site - but opted for WordPress in the 2020-2021 version because static sites do come with _some_ extra manual work no matter how you cut it. WordPress with its online admin interface abstracts a lot of that away - and it's genuinely a pleasurable experience to actually write and publish.

With that being said however, I'm in a performance phase right now, so everything has to be as small as possible. Inspired by posts like ["Why your website should be under 14kb in size"](https://endtimes.dev/why-your-website-should-be-under-14kb-in-size/) - I wanted to push out a minimal, super performant site, and learn some things along the way.

## Picking a Static Site Generator

I had a long dive into all the static generators available, but unfortunately so many of them are bundled into SPAs (Single Page Applications) with JavaScript frameworks. Don't get me wrong, I love JavaScript - but as soon as you start throwing a library in front of your site you end up hitting the 14kb limit really quickly. I found [Cobalt](https://cobalt-org.github.io/) and [Zola](https://getzola.org) - both Rust implementations of SSGs (Static Site Generators), and opted for Zola because of the available themes.

## Migrating from WordPress

WordPress thankfully has a very easy export interface. I pushed my previous posts (albeit not a huge amount) into an .xml file, and thought about making a conversion script from .xml to .md. Luckily, somebody had the same thought before me.

[wordpress-to-zola](https://github.com/TatriX/wordpress-to-zola) was a super easy to use conversion script. I threw my .xml export into the root directory and ran `cargo run`, and it was done. The only thing I noticed on a spot check was my hyphens ended up being prefixed with "\" - I'm not sure if the script did this or if it was something else along the way - since I only noticed it later, but it's worth double-checking the output if anyone is following along.

## Setting up Zola

Most of the setup was out-of-the-box following the Zola install instructions, but there were some gotchas.

### Directory structure

My WordPress installation had "SEO friendly" URLs, including things like the date (e.g. /2020/01/20/slug-here). I think Zola by default expects a more flat structure. To ensure my posts ended up in the posts index, I had to add an `_index.md` file to each directory with the following contents:

```md
+++
transparent = true
in_search_index = false
render = false
+++
```

`transparent = true` is the line that surfaces the posts to the top level index. `in_search_index` and `render` were needed to prevent those directories showing up in the sitemap, and being visitable on their own.

### Aliases

I also noticed after conversion that an old post had an incorrect title. Nobody visits this blog, but as an exercise in corrrectness I wanted to make sure that old URLs would redirect correctly. This can be achieved in the markdown front-matter, with the `aliases` property. For example, [this post](@/posts/2020/06/01/game-development-a-beginning/index.md) was incorrectly titled "hello-world-2" in my WordPress blog. So `aliases = ["posts/2020/06/01/hello-world-2"]` was required to forward the old link correctly.

### Images

I have a handful of images in some posts. There are a few ways to achieve asset linking in Zola, but the easiest for me was to throw the image in the same directory as the post. Unfortunately to make the relative images work correctly - I had to restructure my posts a little from:

```md
- /2022
  - /08
    - /29
      - wordpress-to-zola.md
```

to:

```md
- /2022
  - /08
    - /29
      - /wordpress-to-zola
        - index.md
```

Then, I could simply throw images into the post folder, and reference them relatively with simple markdown.

## Deployment

I used Netlify to deploy this blog, and there's a great setup guide in the Zola docs for exactly how to do this. You can find that [here](https://www.getzola.org/documentation/deployment/netlify/).

## To conclude

That's about it, all in all I'd say the migration took about an hour with the gotchas involved - but with that knowledge in mind would have taken 15 minutes if I were to do it again. I wanted to check my PageSpeed Insights score, which hit 100 in mobile and desktop - a promising start. Checking the Network tab in Chrome Dev Tools further impressed me, with just 3kb sent over the initial load. Using the Netlify static-site CDN should make the site near instant for anyone around the world to load. Neat!

### Update

I _am_ having an issue right now with minification of code blocks. In development mode, the minification does not affect `pre` tags, as expected. However, in build and deployment, the spacing is removed from code blocks. As you can probably tell from the code blocks in this article, the formatting is therefore broken. Still working on this, and will update the post if I find a solution. If you have any ideas, please let me know!
