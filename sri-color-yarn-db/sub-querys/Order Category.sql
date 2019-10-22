select * from (
                select c.*,
                  coalesce(nullif(c.parent_category, 0), c.cat_id) as groupID,
                  case when c.parent_category = 0 then 1 else 0 end as isparent,
                  case when p.`status` = 'active' then c.cat_id end as orderbyint
                from category c
                  left join category p on p.cat_id = c.parent_category
              ) c order by groupID, isparent desc, orderbyint, cat_desc

select * from category