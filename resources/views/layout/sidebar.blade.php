<div class="col-md-4">
                      <div id="sidebar">
                        <div class="container-fluid">
                          <div class="searchform-wrap">
                            <ul>
                              <li class="side-title-head"> Search this Site </li>
                                <form action="{{ route('blog') }}">
                                  <div class="form-group">
                                      <input placeholder="Search on the site" value="{{ request('term') }}" name="term" class="s" type="text">
                                  </div>
                                      <button type="submit" class="loststorage btn btn-primary"><i class="fa fa-search">SEARCH</i></button>
                                  </form>
                            </ul>
                          </div>
                          <div class="category">
                            <ul>
                              <li class="side-title-head"> Blog Categories </li>
                              @foreach ($categories as $category)
                              <li><a href="{{ route('category', $category->slug) }}">{{ $category->title }} ({{ $category->posts->count() }})</a></li>
                              @endforeach
                            </ul>
                          </div>
                          <div class="popular-post">
                            <ul>
                              <li class="side-title-head"> POPLAR TANESHIMA</li>
                              @foreach ($popularPosts as $post)
                              <li>
                                @if ($post->image_thumb_url)
                                <div>
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                      <img width="50px" src="{{ $post->image_thumb_url }}">
                                    </a>
                                </div>
                                @endif
                                <div >
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                      <h5>{{ $post->title }}</h5>
                                      <p>{{ $post->date }}</p>
                                    </a>
                                </div>
                              </li>
                              @endforeach
                            </ul>
                          </div>
                          <div class="popular-post">
                            <ul>
                              <li class="side-title-head"> TAGS</li>
                              <li>
                                <ul class="tags">
                                  @foreach($tags as $tag)
                                    <li><a href="{{ route('tag', $tag->slug) }}">{{ $tag->name }}</a></li>
                                  @endforeach
                                </ul>
                              </li>
                            </ul>
                          </div>
                          <div class="archives">
                            <ul>
                              <li class="side-title-head"> Blog Archives </li>
                              @foreach ($archives as $archive)
                                <li>
                                  <a href="{{ route('blog', ['month' => $archive->month, 'year' => $archive->year]) }}">{{ $archive->month . " " . $archive->year }}</a>
                                  <span class="badge pull-right">{{ $archive->post_count }}</span>
                                </li>
                              @endforeach
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>