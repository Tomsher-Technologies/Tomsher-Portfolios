@extends('layouts.app')

@section('content')
<style>
    .copy-all-links-btn {
        position: absolute;
        top: 8px;
        right: 16px;
        /* background-color: #3494e6; */
        background-color: #0058a2;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 5px 10px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .copy-all-links-btn:hover {
        background-color: #2f6f9e;
    }

    .portfolio-container {
        /* background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); */
        min-height: 100vh;
        padding: 2rem 0;
    }
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    /* .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    } */
    .card-header {
        background: linear-gradient(45deg, #0058a2, #ffffff);
        color: white;
        border-bottom: none;
    }
    .btn-primary {
        background: linear-gradient(45deg, #3494e6, #ec6ead);
        border: none;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(236,110,173,0.4);
    }
    .btn-outline-secondary {
        border-color: #3494e6;
        color: #3494e6;
    }
    .btn-outline-secondary:hover {
        background-color: #3494e6;
        color: white;
    }
    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #c3cfe2;
    }
    .portfolio-item {
        background: white;
        border-radius: 10px;
        /* padding: 1rem; */
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    /* .portfolio-item:hover {
        transform: translateX(5px);
        box-shadow: -5px 5px 15px rgba(0,0,0,0.1);
    } */
    .portfolio-url {
        color: #000000;
        font-weight: 600;
        text-decoration: none;
    }
    .portfolio-description {
        color: #666;
        font-style: italic;
        user-select: none; /* Disable text selection */
        pointer-events: none; /* Prevent interaction */
    }
    .category-title {
        position: relative;
        display: inline-block;
        margin-bottom: 1.5rem;
    }
    .category-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 50%;
        height: 3px;
        background: linear-gradient(45deg, #3494e6, #ec6ead);
    }
    .copy-btn {
        background-color: #3494e6;
        color: white;
        border: none;
        padding: 5px 10px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .copy-btn:hover {
        background-color: #2f6f9e;
    }
    .copied {
        background-color: #2ecc71;
        color: white;
    }
</style>

<div class="portfolio-container">
    <div class="container">
        <div class="card">
            <div class="card-header row" style="background: white;">
                <h5 class="col-md-12 mb-1 h4 text-center" style="color: #000000">Portfolios</h5>
                <div class="col-md-12 ">
                    <form class="row" id="sort_brands" action="" method="GET">

                        <div class="col-md-4 input-group mt-2">
                            <input type="text" class="form-control" id="search" name="search"@isset($search) value="{{ $search }}" @endisset placeholder="Type title or site link">
                        </div>
        

                        <div class="col-md-4 mt-2">
                            <select name="category" class="form-control aiz-selectpicker" data-live-search="true">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="col-md-4 mt-2">
                            <select name="industry" class="form-control aiz-selectpicker" data-live-search="true">
                                <option value="">Select Industry</option>
                                @foreach($industries as $industry)
                                    <option value="{{ $industry->id }}" {{ request('industry') == $industry->id ? 'selected' : '' }}>
                                        {{ $industry->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="col-md-4 mt-2">
                            <select name="technology" class="form-control aiz-selectpicker" data-live-search="true">
                                <option value="">Select Technology</option>
                                @foreach($technologies as $technology)
                                    <option value="{{ $technology->id }}" {{ request('technology') == $technology->id ? 'selected' : '' }}>
                                        {{ $technology->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="col-md-4 mt-2">
                            <button class="btn btn-info " type="submit">Filter</button>
                            <a href="{{ route('home') }}" class="btn btn-cancel">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body" style="min-height:500px">
                <div class="row">
                    @if (!empty($categoryPortfolios))
                        @foreach ($categoryPortfolios as $key => $category)
                            @if($category->portfolios?->isNotEmpty())
                                <div class="col-md-6 mt-4">
                                    <!-- Category Box -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h6>{{ $category->name }} ({{$category->portfolios->count()}})</h6>
                                            <button class="copy-all-links-btn" data-category="{{ $category->id }}">Copy All Links</button>
                                        </div>
                                        <div class="card-body">
                                            <div class="portfolio-item">
                                                @foreach($category->portfolios as $portfolio)
                                                   
                                                    <a href="{{ $portfolio->site_url }}" target="_blank" class="portfolio-url">{{ $portfolio->site_url }}</a>
        
                                                    @if ($portfolio->description)
                                                        <span class="portfolio-description" onmousedown="return false" onselectstart="return false">&nbsp;({{ $portfolio->description }})
                                                        </span>
                                                    @endif
                                                    
                                                    <br>
                                                      
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
            
                                </div>
                            @endif
                        @endforeach
                    @endif

                    @if (!empty($portfolios) && $portfolios->isNotEmpty())   
                        <div class="col-md-6 mt-4">
                            <!-- Category Box -->
                            <div class="card">
                                <div class="card-header">
                                    <h6>Filtered Result ({{$portfolios->count()}})</h6>
                                    <button class="copy-all-links-btn" data-category="1">Copy All Links</button>
                                </div>
                                <div class="card-body">
                                    <div class="portfolio-item">
                                        @foreach ($portfolios as $port)
                                            
                                            <a href="{{ $port->site_url }}" target="_blank" class="portfolio-url">{{ $port->site_url }}</a>
            
                                            @if ($port->description)
                                                <span class="portfolio-description" onmousedown="return false"  onselectstart="return false"> &nbsp;({{ $port->description }})
                                                </span>
                                            @endif
                                            <br>
                                            
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @if (empty($categoryPortfolios))
                            <div class="col-md-12 mt-4 text-center">   
                                No Result Found.
                            </div>
                        @endif
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        const copyAllLinksButtons = document.querySelectorAll('.copy-all-links-btn');
        
        copyAllLinksButtons.forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-category');
                const categoryBox = this.closest('.card');
                const links = categoryBox.querySelectorAll('.portfolio-url');
                
                let allLinks = '';
                links.forEach(link => {
                    allLinks += link.href + '\n';
                });
                
                navigator.clipboard.writeText(allLinks.trim()).then(() => {
                    button.textContent = 'Copied!';
                    setTimeout(() => {
                        button.textContent = 'Copy All Links';
                    }, 4000);
                });
            });
        });
    });

    document.addEventListener('copy', function(event) {
        var selection = window.getSelection();
        var selectedText = selection.toString().trim();

        // Regular expression to find all URLs in the selection
        var urlPattern = /(https?:\/\/[^\s]+)/g;
        var urlMatches = selectedText.match(urlPattern);

        if (urlMatches) {
            // Allow copying only the extracted URLs, separating them with new lines
            event.preventDefault();
            var urlsToCopy = urlMatches.join("\n"); // Copy all URLs in a new line format

            if (navigator.clipboard) {
                navigator.clipboard.writeText(urlsToCopy).then(function() {
                    console.log('URLs copied to clipboard!');
                }).catch(function(err) {
                    console.error('Error copying text: ', err);
                });
            } else {
                // Fallback for older browsers
                var tempInput = document.createElement("textarea");
                tempInput.value = urlsToCopy;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand("copy");
                document.body.removeChild(tempInput);
            }
        } else {
            // If no valid URLs are found in the selection, prevent copying
            event.preventDefault();
            console.log('Only URLs can be copied');
        }
    });


</script>



@endsection
