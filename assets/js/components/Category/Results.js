import axios from "./Axios";

const { useEffect } = wp.element;

function ResultsNew(props) {
  const getPostsData = () => {
    console.log(
      `https://new.marche.be${props.siteSlug}wp-json/ca/v1/all/${props.mainCategoryId}`
    );
    axios
      .get(`${props.siteSlug}wp-json/ca/v1/all/${props.mainCategoryId}`)
      .then((res) => {
        props.setPosts(res.data);
      })
      .catch((err) => console.log(err.message));
  };

  useEffect(() => {
    if (props.categoriesIds.length !== 0) {
      getPostsData();
    }
  }, [props.siteSlug, props.categoriesIds]);

  useEffect(() => {
    if (props.selectedCategory == 0) {
      props.setFilteredPosts(props.posts);
    } else {
      let filteredPosts = props.posts.filter((object) => {
        return object.react_category_filter.find(
          (elem) => elem == props.selectedCategory
        );
      });
      props.setFilteredPosts(filteredPosts);
    }
  }, [props.posts, props.selectedCategory]);

  return (
    <div className="pt-24px">
      <ul className="d-flex mx-n12px flex-wrap">
        {props.filteredPosts.map((object, index) => {
          return (
            <li key={index} className="pb-12px px-12px col-12 col-md-6">
              <a
                href={object.link}
                className="border border-default p-24px shadow-sm d-block"
              >
                <h3
                  className="fs-short-2 ff-semibold text-dark-primary text-hover-primary transition-all ellipsis"
                  dangerouslySetInnerHTML={{
                    __html: `${object.react_category_filter.join(" | ")} ${
                      object.post_title
                    }`,
                  }}
                />
                <span
                  className="d-block pt-8px fs-short-3 ellipsis text-dark-primary"
                  dangerouslySetInnerHTML={{
                    __html: `excerpt here`,
                  }}
                />
              </a>
            </li>
          );
        })}
      </ul>
    </div>
  );
}

export default ResultsNew;
