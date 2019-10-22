select a.cat_id as 'cat_id' ,
       a.cat_desc as 'cate_desc' ,
       b.cat_desc as 'pare_cate_desc',
       group_concat(c.cat_desc order by c.cat_id asc) as 'category_name',
       Concat( IFNULL(Concat(REPLACE(group_concat(c.cat_desc order by c.cat_id asc),',','>'),'>'),''), '', IFNULL(a.cat_desc,'')) as 'result'
from category a
  left JOIN category b on (a.parent_category=b.cat_id)
  left JOIN category c on find_in_set(c.cat_id,a.par_cat_order)
WHERE a.status='active'
GROUP by a.cat_id ORDER by result ASC