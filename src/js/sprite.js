const init = () => {
    const req = require.context('@src/icons/', false, /\.svg$/);
    requireAll(req);
};

export default { init };

const requireAll = (requireContext) => {
    requireContext.keys().map(requireContext);
};
