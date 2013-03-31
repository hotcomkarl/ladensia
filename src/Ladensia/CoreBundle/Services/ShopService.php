<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */
/**
 * ShopService.php
 *
 * @category            Ladensia
 * @package             CoreBundle
 * @subpackage          Service
 */

namespace Ladensia\CoreBundle\Service;

//use Application\TicketBundle\Model\Ticket;
//use Application\TicketBundle\Model\Ticket\Mapper;
//use Application\UserBundle\Model\User;


class ShopService {
    
   /**
   * Builds up the categorie tree
   *
   * @param string $catId
   * @return string $list
   */

    public function buildCategoryOptions($catId = 0) {
        $sql = "SELECT cat_id, cat_parent_id, cat_name
			FROM tbl_category
			ORDER BY cat_id";
        $result = dbQuery($sql) or die('Cannot get Product. ' . mysql_error());

        $categories = array();
        while ($row = dbFetchArray($result)) {
            list($id, $parentId, $name) = $row;

            if ($parentId == 0) {
                // we create a new array for each top level categories
                $categories[$id] = array('name' => $name, 'children' => array());
            } else {
                // the child categories are put int the parent category's array
                $categories[$parentId]['children'][] = array('id' => $id, 'name' => $name);
            }
        }

        // build combo box options
        $list = '';
        foreach ($categories as $key => $value) {
            $name = $value['name'];
            $children = $value['children'];

            $list .= "<optgroup label=\"$name\">";

            foreach ($children as $child) {
                $list .= "<option value=\"{$child['id']}\"";
                if ($child['id'] == $catId) {
                    $list.= " selected";
                }

                $list .= ">{$child['name']}</option>\r\n";
            }

            $list .= "</optgroup>";
        }

        return $list;
    }
    
    /*
      If you want to be able to add products to the first level category
      replace the above function with the one below
     */
    /*

      function buildCategoryOptions($catId = 0)
      {
      $sql = "SELECT cat_id, cat_parent_id, cat_name
      FROM tbl_category
      ORDER BY cat_id";
      $result = dbQuery($sql) or die('Cannot get Product. ' . mysql_error());

      $categories = array();
      while($row = dbFetchArray($result)) {
      list($id, $parentId, $name) = $row;

      if ($parentId == 0) {
      // we create a new array for each top level categories
      $categories[$id] = array('name' => $name, 'children' => array());
      } else {
      // the child categories are put int the parent category's array
      $categories[$parentId]['children'][] = array('id' => $id, 'name' => $name);
      }
      }

      // build combo box options
      $list = '';
      foreach ($categories as $key => $value) {
      $name     = $value['name'];
      $children = $value['children'];

      $list .= "<option value=\"$key\"";
      if ($key == $catId) {
      $list.= " selected";
      }

      $list .= ">$name</option>\r\n";

      foreach ($children as $child) {
      $list .= "<option value=\"{$child['id']}\"";
      if ($child['id'] == $catId) {
      $list.= " selected";
      }

      $list .= ">&nbsp;&nbsp;{$child['name']}</option>\r\n";
      }
      }

      return $list;
      }
     */
    
   /**
   * Builds up the navigation
   *
   * @param string $sql, $pageNum, $rowsPerPage, $queryString
   * @return Navigation
   */

    public function getPagingNav($sql, $pageNum, $rowsPerPage, $queryString = '') {
        $result = mysql_query($sql) or die('Error, query failed. ' . mysql_error());
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        $numrows = $row['numrows'];

        // how many pages we have when using paging?
        $maxPage = ceil($numrows / $rowsPerPage);

        $self = $_SERVER['PHP_SELF'];

        // creating 'previous' and 'next' link
        // plus 'first page' and 'last page' link
        // print 'previous' link only if we're not
        // on page one
        if ($pageNum > 1) {
            $page = $pageNum - 1;
            $prev = " <a href=\"$self?page=$page{$queryString}\">[Vorherige]</a> ";

            $first = " <a href=\"$self?page=1{$queryString}\">[Erste Seite]</a> ";
        } else {
            $prev = ' [Vorherige] ';       // we're on page one, don't enable 'previous' link
            $first = ' [Erste Seite] '; // nor 'first page' link
        }

        // print 'next' link only if we're not
        // on the last page
        if ($pageNum < $maxPage) {
            $page = $pageNum + 1;
            $next = " <a href=\"$self?page=$page{$queryString}\">[Nächste]</a> ";

            $last = " <a href=\"$self?page=$maxPage{$queryString}{$queryString}\">[Letzte Seite]</a> ";
        } else {
            $next = ' [Nächste] ';      // we're on the last page, don't enable 'next' link
            $last = ' [Letzte Seite] '; // nor 'last page' link
        }

        // return the page navigation link
        // return $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last;
        return $first . $prev . " Seiten anzeigen <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last;
    }
    
}