<!-- Parent and Sub Category Query -->

 SELECT 
    a.cat_id AS 'cat_id',
    a.cat_desc AS 'cate_desc',
    b.cat_desc AS 'pare_cate_desc',
    GROUP_CONCAT(c.cat_desc
        ORDER BY c.cat_id ASC) AS 'category_name',
    CONCAT(IFNULL(CONCAT(REPLACE(GROUP_CONCAT(c.cat_desc
                                    ORDER BY c.cat_id ASC),
                                ',',
                                '>'),
                            '>'),
                    ''),
            '',
            IFNULL(a.cat_desc, '')) AS 'result'
FROM
    category a
        LEFT JOIN
    category b ON (a.parent_category = b.cat_id)
        LEFT JOIN
    category c ON FIND_IN_SET(c.cat_id, a.par_cat_order)
GROUP BY a.cat_id
ORDER BY result

<!-- /Parent and Sub Category Query -->

<!-- Parent and Sub Category Order Wise Query -->

SELECT 
    a.cat_id,
    a.cat_desc,
    b.cat_desc,
    GROUP_CONCAT(c.cat_desc
        ORDER BY c.cat_id ASC)
FROM
    category a
        LEFT JOIN
    category b ON (a.parent_category = b.cat_id)
        LEFT JOIN
    category c ON FIND_IN_SET(c.cat_id, a.par_cat_order)
GROUP BY a.cat_id

<!-- /Parent and Sub Category Order Wise Query -->

<!-- Getting Tax Group Id state code -->
SELECT tax.*,
  tax_zone.zone_desc,
  tax_group.tax_groups_desc,
  tax_group.tax_id_groups
FROM tax
  JOIN tax_zone ON (tax.tax_zone_id=tax_zone.zone_id)
  LEFT JOIN  tax_group ON(FIND_IN_SET(tax.tax_id,tax_group.tax_id_groups)>0)
WHERE find_in_set('37',tax_zone.zone_codes)>0 AND tax_group.tax_group_id=1;

<!-- /Getting Tax Group Id state code -->

