import { fetchPosts } from './service/posts-service';
import PostItem from './PostItem';

const {
    useState,
    useEffect
} = wp.element;

function PostResults( propos ) {
    const [ posts, setPosts ] = useState([]);
    const [ loading, setLoading ] = useState( false );

    async function loadPosts() {
        setLoading( true );
        let response;
        try {
            response = await fetchPosts( propos.siteSlug, propos.catId );
            setPosts( response.data );
            setLoading( false );
        } catch ( e ) {
            setLoading( false );
        }
        return null;
    }

    useEffect( () => {
        if ( 0 < propos.catId ) {
            loadPosts();
        }
    }, [ propos.catId ]);

    const listItems = posts.map( ( object, index ) => (
        <PostItem
            key={object.ID}
            item={object}
        />
    ) );

    return (
        <div className="pt-24px">
            <ul className="d-flex mx-n12px flex-wrap">
                {listItems}
            </ul>
        </div>
    );
}

export default PostResults;
