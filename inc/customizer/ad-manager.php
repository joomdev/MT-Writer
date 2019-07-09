<?php
//
// ─── ASSIGNING ADS AT SPECIFIED POSITION (POSTS LEVEL) ────────────────────────────
//    
if ( get_theme_mod('ads_posts') || get_theme_mod('ads_pages') ) {
    /* Advertisement at middle */
    if ( get_theme_mod('ad_code_post_middle') ) {
        add_filter('the_content', 'mtwriter_insert_ads_middle');
        function mtwriter_insert_ads_middle($content) {
            $insertion = get_theme_mod('ad_code_post_middle');

            $totalParagraphs = preg_match_all('#</p>#i', $content, $matches, PREG_SET_ORDER+PREG_OFFSET_CAPTURE);
            $middleParagraph = floor($totalParagraphs / 2);
            
            if( get_theme_mod('ads_posts') ) {
                if (is_single() && ! is_admin()) {
                    return mtwriter_insert_after_paragraphs($content, $insertion, array($middleParagraph));
                }
            }
            
            if( get_theme_mod('ads_pages') ) {
                if (is_page() && ! is_admin()) {
                    return mtwriter_insert_after_paragraphs($content, $insertion, array($middleParagraph));
                }
            }
            
            return $content;
        }
    }

    /* Advertisement before the last paragraph */
    if ( get_theme_mod('ad_before_last_paragraph') ) {
        add_filter('the_content', 'mtwriter_insert_ads_before_last');
        
        function mtwriter_insert_ads_before_last($content) {
            $insertion = get_theme_mod('ad_before_last_paragraph');
            
            $totalParagraphs = preg_match_all('#</p>#i', $content, $matches, PREG_SET_ORDER+PREG_OFFSET_CAPTURE);
            $lastParagraph = floor($totalParagraphs - 1);
            
            if( get_theme_mod('ads_posts') ) {
                if (is_single() && ! is_admin()) {
                    return mtwriter_insert_after_paragraphs($content, $insertion, array($lastParagraph));
                }
            }
            
            if( get_theme_mod('ads_pages') ) {
                if (is_page() && ! is_admin()) {
                    return mtwriter_insert_after_paragraphs($content, $insertion, array($lastParagraph));
                }
            }
            
            return $content;
        }
    }

    /* Advertisement after the numbered paragraph */
    if ( get_theme_mod('paragraph_number') && get_theme_mod('ad_after_numbered_paragraph')) {
        add_filter('the_content', 'mtwriter_insert_ads_after_number');
        function mtwriter_insert_ads_after_number($content) {
            $insertion = get_theme_mod('ad_after_numbered_paragraph');

            $paragraphNumber = (int) get_theme_mod('paragraph_number');
            
            if( get_theme_mod('ads_posts') ) {
                if (is_single() && ! is_admin()) {
                    return mtwriter_insert_after_paragraphs($content, $insertion, array($paragraphNumber));
                }
            }
            
            if( get_theme_mod('ads_pages') ) {
                if (is_page() && ! is_admin()) {
                    return mtwriter_insert_after_paragraphs($content, $insertion, array($paragraphNumber));
                }
            }

            return $content;
        }
    }

    // Function that makes the magic happen correctly
    function findMatches($match)
    {
        return $match[0][1] + 4; // return string offset + length of </p> Tag
    }
    
    function mtwriter_insert_after_paragraphs($content, $insertion, $paragraph_indexes) {
        // find all paragraph ending offsets
        preg_match_all('#</p>#i', $content, $matches, PREG_SET_ORDER+PREG_OFFSET_CAPTURE);

        // reduce matches to offset positions        
        /* Compatible with PHP v5 */
        $matches = array_map("findMatches", $matches);

        /* Compatible with PHP v7 */
        // $matches = array_map(function($match) {
        //     return $match[0][1] + 4; // return string offset + length of </p> Tag
        // }, $matches);
        
        // cycle through and insert on demand
        foreach ($paragraph_indexes as $paragraph_index) {
            if ($paragraph_index <= count($matches)) {
                $offset_position = $matches[$paragraph_index-1];
                $content = substr($content, 0, $offset_position) . $insertion . substr($content, $offset_position);
            }
        }
        
        return $content;
    }
}
